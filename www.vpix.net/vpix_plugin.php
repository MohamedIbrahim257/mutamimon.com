<krpano>
    <action name="start_tour">
        if (vpix_gs_lang !== null, act_vpix_i18n_set_names(););

        act_vpix_init_gs();
        delayedcall(0.25, act_vpix_resize_combobox(combobox, 0.90));
        if (only_scene,
          <!--
          act_show_for_app() is called in vpix_act_scene_changed for every scene.
          It is also called here before showing the first pano to avoid plugins/layers
          and hotspots appearing briefly on the tour before they get hidden.
          -->
          if (only_scene == -1, act_show_for_app();start_tour_normal();, enact_only_scene(get(only_scene)));
        ,
          start_tour_normal();
        );
        <!--
         2020-12-30: Hide navigation and zoom controls on small screen devices.
         They are overlapping the other controls. Also, on small screen device,
         which are most likely touch screen devices, arrow keys for navigation
         doesn't make sense when the user can just swipe in desired direction.
        -->
        if (stagewidth LE 600 OR stageheight LE 600,
          set(plugin[pi_up].visible, false);
          set(plugin[pi_down].visible, false);
          set(plugin[pi_left].visible, false);
          set(plugin[pi_right].visible, false);
          set(plugin[pi_zoomin].visible, false);
          set(plugin[pi_zoomout].visible, false);
        );
    </action>
    <!--
      %1 = action for the default start scene
      %2 = show floor plan on start (true/false)
    -->
    <action name="act_delayed_start">
      if (start_scene
      , txtadd(start_action, 'act_change_scene_', get(start_scene));
        if (action[get(start_action)], action(get(start_action), true);, action(%1, true););
      , if (vpix_gs_scene_in_url_hash
        , act_scene_id_from_url_hash(start_action);
          if (action[get(start_action)], action(get(start_action), true);, action(%1, true););
        , action(%1, true);
        );
      );
      ifnot (vpix_gs_scene_in_url_hash, js(change_url_hash('')););
      if (%2, act_floor_plan_show();, act_floor_plan_hide(););
      if(ext_buttonless EQ '1', act_make_buttonless(););
    </action>
    <!--
        Action to load a scene by name (first parameter), second parameter indicates whether this
        is the first scene to be loaded on start.
        If it is first scene, there will be no blending, else there will be blending.
    -->
    <action name="act_load_scene">
        if (%2 OR vpix_gs_first_scene, loadscene(%1, null, MERGE);, loadscene(%1, null, MERGE, ZOOMBLEND(1, 4)););
        if (%3 !== null AND %4 !== null AND %5 !== null, lookat(%3, %4, %5););
        if (vpix_gs_scene_in_url_hash,
          act_id_from_scene_name(%1, vpix_scene_id);
          js(change_url_hash(get(vpix_scene_id)););
        );
    </action>

    <!--
        Action to do call a set of actions that have to be executed when
        a new scene is loaded.
    -->
    <action name="vpix_act_scene_changed">
        <!--
        scene change generally happens with some kind of user interaction exception being
        when auto-spin is enabled.
        So, when scene is changed and soundinterface is present,
        enable audio if vpix_autospin_on is not defined. If vpix_autospin_on is defined,
        enable audio only if auto-spin is disabled.
        -->
        if (vpix_gs_first_scene === false AND plugin[pi_soundinterface],
          if (vpix_autospin_on === null,
            vpix_audio_ready();
          ,
            ifnot(vpix_autospin_on, vpix_audio_ready(););
          );
        );
        set(vpix_gs_first_scene, false);
        if (only_scene == -1, act_show_for_app(););
        <!--
          Callback to the javascript code saying that a new pano/scene has been
          loaded. If anything has to be done on javascript side on scene change,
          it has to be done through the VpixTour.sceneChanged. This will be the
          one point of entry. All javascript calls etc. have to be done from
          this function.
        -->
        js(VpixTour.sceneChanged(););

        if(plugin[webvr] AND plugin[webvr].isenabled, act_vpix_disable_hotspots_for_vr(););
    </action>

    <!-- layers/plugins are interchangeable -->
    <action name="act_make_buttonless">
        for(set(i,0), i LT plugin.count, inc(i),
            set(plugin[get(i)].prev_visibility, get(plugin[get(i)].visible));
            if(plugin[get(i)].name == 'pi_fb_fullscreen_holder' OR plugin[get(i)].name == 'pi_fb_fullscreen'
            ,   set(plugin[get(i)].visible, true);
            ,   set(plugin[get(i)].visible, false);
            );
        );
        set(autorotate.enabled, false);
    </action>
    <action name="act_buttonless_fullscreen">
        for(set(i,0), i LT plugin.count, inc(i),
            set(plugin[get(i)].visible, get(plugin[get(i)].prev_visibility));
            if(plugin[get(i)].name == 'pi_fb_fullscreen_holder' OR plugin[get(i)].name == 'pi_fb_fullscreen' OR plugin[get(i)].name == 'pi_full_screen',
                set(plugin[get(i)].visible, false);
            );
        );
        set(autorotate.enabled, get(glst_auto_rotate));
    </action>

    <action name="act_vpix_vr_entered" scope="local">
      for(set(i,0), i LT layer.count, inc(i),
        set(layer[i].visible, false);
      );
      act_vpix_disable_hotspots_for_vr();
    </action>
    <action name="act_vpix_vr_exited" scope="local">
      act_vpix_enable_hotspots();
    </action>

    <!-- Only the hotspots linking to other panos and vr_cursor hotspot should be
         visible. All other hotspots should be hidden as they do not work on vr.
         For example: infobox, hd photo, mp4 video, audio will all show up in the
         middle, split between the two lenses. -->
    <action name="act_vpix_disable_hotspots_for_vr">
      for(set(i,0), i LT hotspot.count, inc(i),
        ifnot (hotspot[get(i)].name == 'vr_cursor',
          txtsplit(hotspot[get(i)].name, '_', p1, null, null, null);
          ifnot (p1 == 'hs' OR p1 == 'nhs', set(hotspot[get(i)].visible, false););
        );
      );
    </action>

    <action name="act_vpix_enable_hotspots">
      for(set(i,0), i LT hotspot.count, inc(i),
        set(hotspot[get(i)].visible, true);
      );
    </action>

    <plugin name="pi_fb_fullscreen_holder" type="container" bgcolor="0x000000" bgalpha="0.65"
            width="100%" align="bottom" x="0" y="0" height="60" keep="true" visible="false" />

    <plugin name="pi_fb_fullscreen" type="image" url="%CURRENTXML%/assets/full-screen-orange-button.png"
            align="bottom" x="0" y="10" width="150" height="40" keep="true" visible="false"
            enabled="true" onhover="showtext(Full screen);" onclick="switch(fullscreen);" 
            parent="plugin[pi_fb_fullscreen_holder]"
        />

    <events
        onenterfullscreen="act_fullscreen_plugin_disable()"
        onexitfullscreen="act_fullscreen_plugin_enable()"
        onresize="act_vpix_on_resize()"
        onclick="js(VpixTour.playerClicked(););"
        gyro_onavailable="delayedcall(5.0, act_vpix_ask_gyro_permisson(););"
        webvr_onentervr="act_vpix_vr_entered();"
        webvr_onexitvr="act_vpix_vr_exited();"
        ></events>

    <action name="act_fullscreen_plugin_disable">
        if (ext_buttonless == '1', act_buttonless_fullscreen(););
    </action>

    <action name="act_fullscreen_plugin_enable">
        if (ext_buttonless == '1', act_make_buttonless(););
    </action>

    <action name="act_vpix_on_resize" scope="local">
      ifnot (plugin[webvr] AND plugin[webvr].isenabled,
        act_is_small_screen(vpix_gs_small_screen);
        if (vpix_gs_small_screen,
          if (plugin[pi_embed_share], set(plugin[pi_embed_share].visible, false););
          if (layer[vt_thumbs_holder], set(layer[vt_thumbs_holder].visible, false););
          if (plugin[gmaps],
            set(plugin[gmaps].visible, false);
            set(plugin[pi_show_map].visible, false);
            set(plugin[pi_hide_gmap].visible, false);
          );
          if (plugin[pi_tour_link_holder],
            set(plugin[pi_tour_link_holder].visible, false);
            if (layer[lyr_tour_link],
              set(layer[lyr_tour_link].visible, false);
              set(layer[pi_tour_link_holder_mobile].visible, false);
              if (only_scene != -1 OR vpix_gs_pt_tour_links === true,
                set(layer[lyr_tour_link].visible, true);
                for (set(i,0), i LT plugin.count, inc(i),
                  if (plugin[get(i)].parent EQ 'layer[pi_tour_link_holder_mobile]', set(plugin[get(i)].visible, true));
                );
              );
            );
          );
        ,
          if (only_scene != -1,
            if (plugin[pi_embed_share], set(plugin[pi_embed_share].visible, true););
            if (layer[vt_thumbs_holder], set(layer[vt_thumbs_holder].visible, true););
          );
          if (plugin[pi_tour_link_holder],
            set(plugin[pi_tour_link_holder].visible, false);
            if (layer[lyr_tour_link],
              set(layer[lyr_tour_link].visible, false);
              set(layer[pi_tour_link_holder_mobile].visible, false);
            );
            if (only_scene != -1 OR vpix_gs_pt_tour_links === true,
              set(plugin[pi_tour_link_holder].visible, true);
              for (set(i,0), i LT plugin.count, inc(i),
                if (plugin[get(i)].parent EQ 'plugin[pi_tour_link_holder]', set(plugin[get(i)].visible, true));
              );
            );
          );
          if (plugin[gmaps],
            if (only_scene,
              set(plugin[gmaps].visible, false);
              set(plugin[pi_show_map].visible, false);
              set(plugin[pi_hide_gmap].visible, false);
            ,
              set(plugin[gmaps].visible, get(plugin[gmaps].orig_visible));
              set(plugin[pi_show_map].visible, get(plugin[gmaps].orig_visible));
              set(plugin[pi_hide_gmap].visible, get(plugin[gmaps].orig_visible));
            );
          );
        );
        vpix_act_resize_logo_iff();
      );
    </action>

    <action name="enact_only_scene">
        loadscene(%1);
        for(set(i,0), i LT layer.count, inc(i),
            <!--
            showing/hiding of tour links is handled in the act_vpix_on_resize
            tour link related layers will have names like "lyr_tour_link_<something>"
            and plugins will have names like "pl_tour_link_<something>"
            -->
            txtsplit(get(layer[get(i)].name), '_', vpix_tmp, vpix_tmp_1, vpix_tmp_2);
            if (vpix_tmp_1 != 'tour' AND vpix_tmp_2 != 'link',
              set(layer[get(i)].visible, false);
            );
        );
        for(set(i,0), i LT hotspot.count, inc(i),
            txtsplit(get(hotspot[get(i)].name), '_', vpix_tmp, null, null);
            if (vpix_tmp == 'nhs' OR vpix_tmp == 'ihs',
              if (vpix_tmp == 'nhs' AND vpix_gs_pt_nadir !== true, set(hotspot[get(i)].visible, false););
              if (vpix_tmp == 'ihs' AND vpix_gs_pt_infoboxes !== true, set(hotspot[get(i)].visible, false););
            ,
              set(hotspot[get(i)].visible, false);
            );
        );
        set(autorotate.enabled, false);
        set(glst_auto_rotate, false);
    </action>

    <action name="vpix_act_resize_logo_iff" scope="local">
      if (global.plugin[pi_logo] !== null,
        if (get(global.plugin[pi_logo].orig_width) === NULL,
          set(global.plugin[pi_logo].orig_width, get(global.plugin[pi_logo].width));
          set(global.plugin[pi_logo].orig_height, get(global.plugin[pi_logo].height));
        );
        mul(vpix_ss, global.stagewidth, get(global.stagescale));
        if (vpix_ss LE 420,
          set(vpix_scale, 0.33);
        ,
          if (vpix_ss LE 800,
            set(vpix_scale, 0.66);
          ,
            set(vpix_scale, 1);
          );
        );
        mul(vpix_tmp, global.plugin[pi_logo].orig_width, get(vpix_scale));
        set(global.plugin[pi_logo].width, get(vpix_tmp));
        mul(vpix_tmp, global.plugin[pi_logo].orig_height, get(vpix_scale));
        set(global.plugin[pi_logo].height, get(vpix_tmp));

        if (global.layer[combobox] !== null,
          add(vpix_tmp, global.plugin[pi_logo].y, get(global.plugin[pi_logo].height));
          add(vpix_tmp, 10);
          set(global.layer[combobox].y, get(vpix_tmp));
        );
        if (global.layer[pi_lis_search] !== null, lisa_set_container_y(););
      );
    </action>

    <action name="act_show_for_app">
        for(set(i,0), i LT layer.count, inc(i),
            set(layer[get(i)].visible, false);
        );
        for(set(i,0), i LT hotspot.count, inc(i),
            indexoftxt(vpix_tmp, get(hotspot[get(i)].name), '_');
            subtxt(vpix_tmp, get(hotspot[get(i)].name), 0, get(vpix_tmp));
            if (vpix_tmp == 'hs',
              set(hotspot[get(i)].visible, true);
            ,
              set(hotspot[get(i)].visible, false);
            );
        );
        set(autorotate.enabled, false);
        set(glst_auto_rotate, false);
    </action>

    <action name="act_slide_show_start">
        set(autorotate.enabled, false);
        js(show_slides());
    </action>
    <action name="act_slide_show_stop">
        if (glst_auto_rotate, set(autorotate.enabled, true));
    </action>

    <action name="act_id_from_scene_name" scope="localonly">
      txtsplit(args[0], '_', null, vpix_tmp, null);
      parentscopeset(%2, get(vpix_tmp));
    </action>

    <action name="act_scene_id_from_url_hash" scope="localonly">
      indexoftxt(vpix_tmp_1, get(global.browser.location), '#');
      if (vpix_tmp_1 GT -1,
        txtsplit(global.browser.location, '#', null, vpix_tmp_2);
        txtadd(vpix_tmp_2, 'act_change_scene_', get(vpix_tmp_2));
        parentscopeset(%1, get(vpix_tmp_2));
      ,
        parentscopeset(%1, 'act_change_scene_none');
      );
    </action>
    <action name="act_change_scene_action_from_id">
      txtadd(%2, 'act_change_scene_', %1);
    </action>

    <action name="act_autorotate_clicked" scope="localonly">
      if (global.autorotate.enabled,
        set(global.autorotate.enabled, false);
        set(global.glst_auto_rotate, false);
        act_stop_autospin();
      ,
        set(global.autorotate.enabled, true);
        set(global.glst_auto_rotate, true);
        <!-- college360 theme: auto-rotate implies auto-spin -->
        if (global.layer[vtc_container] !== null, act_start_autospin(););
      );
    </action>

    <action name="act_info_clicked">
       if(device.mouse, switch(plugin[pi_info_screen_1].visible);, switch(plugin[pi_info_screen_2].visible););
    </action>

    <textstyle name="fs_helvetica" font="Helvetica" fontsize="22" bold="true" italic="false"
            background="false" border="false" textcolor="0xFFFFFF" alpha="1"
            yoffset="25" edge="top" blendmode="normal"
            effect="glow(0xFFFFFF, 0.45, 1, 50);dropshadow(2, 45, 0x010101, 2, 55);"
            />

    <textstyle name="default" font="Arial" fontsize="11" bold="true" italic="false"
            textcolor="0xFFFFFF" alpha="1" blendmode="normal"
            background="true" backgroundcolor="0x666666"
            border="true" bordercolor="0xFFFFFF"
            />

    <plugin name="pi_overlay" url="%CURRENTXML%/assets/bg_black.jpg"
        width="100%" height="100%" keep="true" alpha="0.70" visible="false" zorder="210"
        />
    <plugin name="pi_cursor" url="%CURRENTXML%/plugins/qtvr-cursors.png"  />
    <!-- set the qtvr cursor after the xml was loaded -->
    <events name="vpix_common_oncomplete" onxmlcomplete="qtvrcursor();" onloadcomplete="vpix_eh_onloadcomplete();" keep="true" />

    <action name="vpix_eh_onloadcomplete">
        <!--
        Overwrite/redefine this function in tour config to provide tour specific
        functions. This is a placeholder to avoid the 'unknown action' error for
        tours that do not define the vpix_eh_onloadcomplete action.
        vpix_eh_onloadcomplete = vpix-event-handler-onloadcomplete
        -->
    </action>

    <action name="vpix_bing_maps_add_zoom_controls">
      addlayer(gmaps_zoom_in);
      set(layer[gmaps_zoom_in].type, 'text');
      set(layer[gmaps_zoom_in].align, 'topright');
      set(layer[gmaps_zoom_in].parent, 'plugin[gmaps]');
      set(layer[gmaps_zoom_in].x, 4);
      set(layer[gmaps_zoom_in].y, 4);
      set(layer[gmaps_zoom_in].width, 32);
      set(layer[gmaps_zoom_in].height, 32);
      set(layer[gmaps_zoom_in].bg, true);
      set(layer[gmaps_zoom_in].bgcolor, '0xFFFFFF');
      set(layer[gmaps_zoom_in].bgalpha, 1);
      set(layer[gmaps_zoom_in].vcenter, true);
      set(layer[gmaps_zoom_in].css, "font-family:Sans-serif;font-size:24px;line-height:28px;color:#000000;text-align:center;padding:0px;");
      set(layer[gmaps_zoom_in].onclick, 'vpix_bing_maps_zoom_in();');
      set(layer[gmaps_zoom_in].keep, true);
      set(layer[gmaps_zoom_in].visible, true);
      set(layer[gmaps_zoom_in].html, '+');

      addlayer(gmaps_zoom_out);
      set(layer[gmaps_zoom_out].type, 'text');
      set(layer[gmaps_zoom_out].align, 'topright');
      set(layer[gmaps_zoom_out].parent, 'plugin[gmaps]');
      set(layer[gmaps_zoom_out].x, 4);
      set(layer[gmaps_zoom_out].y, 40);
      set(layer[gmaps_zoom_out].width, 32);
      set(layer[gmaps_zoom_out].height, 32);
      set(layer[gmaps_zoom_out].bg, true);
      set(layer[gmaps_zoom_out].bgcolor, '0xFFFFFF');
      set(layer[gmaps_zoom_out].bgalpha, 1);
      set(layer[gmaps_zoom_out].vcenter, true);
      set(layer[gmaps_zoom_out].css, "font-family:Sans-serif;font-size:24px;line-height:28px;color:#000000;text-align:center;padding:0px;");
      set(layer[gmaps_zoom_out].onclick, 'vpix_bing_maps_zoom_out();');
      set(layer[gmaps_zoom_out].keep, true);
      set(layer[gmaps_zoom_out].visible, true);
      set(layer[gmaps_zoom_out].html, '-');
    </action>
    <action name="vpix_bing_maps_zoom_in">
      if (plugin[gmaps].zoom LT 20, inc(plugin[gmaps].zoom));
    </action>
    <action name="vpix_bing_maps_zoom_out">
      if (plugin[gmaps].zoom GT 8, dec(plugin[gmaps].zoom));
    </action>

    <action name="qtvrcursor">
        if (cursors.url === null,
          if (vpix_pan_like_google == '1', set(control.mousetype, drag);, set(control.mousetype, moveto););
          set(cursors.url,  '%CURRENTXML%/plugins/qtvr-cursors.png');
          set(cursors.type, 8way);
          set(cursors.move,       0|0|16|16);
          set(cursors.drag,      16|0|16|16);
          set(cursors.arrow_u,   32|0|16|16);
          set(cursors.arrow_d,   48|0|16|16);
          set(cursors.arrow_l,   64|0|16|16);
          set(cursors.arrow_r,   80|0|16|16);
          set(cursors.arrow_lu,  96|0|16|16);
          set(cursors.arrow_ru, 112|0|16|16);
          set(cursors.arrow_rd, 128|0|16|16);
          set(cursors.arrow_ld, 144|0|16|16);
        );
    </action>
    <action name="hotspot_animate">
        inc(frame,1,get(lastframe),0);
        mul(ypos,frame,frameheight);
        txtadd(crop,0|,get(ypos),|,get(framewidth),|,get(frameheight));
        delayedcall(0.03, if(loaded, hotspot_animate() ) );
    </action>
    <action name="act_is_small_screen" scope="localonly">
      mul(vpix_ss, global.stagewidth, get(global.stagescale));
      if (vpix_ss LT 600, parentscopeset(%1, true);, parentscopeset(%1, false););
    </action>
    <action name="act_vpix_resize_combobox" scope="local">
      txtsplit(get(version), '.', null, local.vpix_krpano_version, null);
      if (device.mobile AND
          plugin[%1] AND
          vpix_krpano_version EQ 20,
        if (plugin[%1].url == '%CURRENTXML%/plugins/combobox.swf' OR
            plugin[%1].url == '%CURRENTXML%/plugins/combobox.js',
          set(plugin[%1].height, 36);
          set(plugin[%1].itemfontsize, 16);
          set(plugin[%1].cbfontsize, 10);
          set(plugin[%1].cbpadding, 6);
          set(local.vpix_tmp_1, get(plugin[%1].width));
          mul(vpix_tmp_1, %2);
          roundval(vpix_tmp_1);
          set(plugin[%1].width, get(vpix_tmp_1));
        );
      );
    </action>

    <action name="act_show_hide_tools">
        switch(plugin[pi_up].visible);
        switch(plugin[pi_down].visible);
        switch(plugin[pi_left].visible);
        switch(plugin[pi_right].visible);
        switch(plugin[pi_zoomin].visible);
        switch(plugin[pi_zoomout].visible);
        switch(plugin[pi_getinfo].visible);
        switch(plugin[pi_rotate].visible);
        switch(plugin[pi_logo].visible);
        switch(plugin[pi_floorplan].visible);
        switch(plugin[pi_fp_radar].visible);
        switch(plugin[pi_show_plan].visible);
        switch(plugin[pi_hide_plan].visible);
        switch(plugin[combobox].visible);
        switch(plugin[pi_show_map].visible);
        switch(plugin[pi_hide_gmap].visible);
        switch(plugin[gmaps].visible);
        switch(plugin[br_top].visible);
        switch(plugin[br_bot].visible);
        switch(plugin[br_right].visible);
        switch(plugin[pi_tour_link_holder].visible);
        switch(plugin[pi_show_tools].visible);
        switch(plugin[pi_hide_tools].visible);
        switch(layer[vt_thumbs_container].visible);
        if(fullscreen, set(plugin[pi_embed_share].visible, false) , switch(plugin[pi_embed_share].visible));
        if(fullscreen, set(plugin[pi_audio_on].visible, false) , switch(plugin[pi_audio_on].visible));
        if(fullscreen, set(plugin[pi_audio_off].visible, false) , switch(plugin[pi_audio_off].visible));
        if(fullscreen, set(plugin[pi_slide_show].visible, false) , switch(plugin[pi_slide_show].visible));
        if(fullscreen, set(plugin[pi_hide_tools].visible, false));
        if(fullscreen, set(plugin[pi_show_tools].visible, false));
    </action>
    <action name="act_vpix_ask_gyro_permisson">
      if (plugin[gyro] AND plugin[gyro].enabled == false,
        set(layer[lyr_ask_gyro_holder].visible, true);
      );
    </action>

    <action name="act_vpix_i18n_set_names" scope="local">
      if (layer[combobox], layer[combobox].removeAll(););
      for(set(i,0), i LT vpix_i18n.count, inc(i),
        set(visn_tmp, get(vpix_i18n[get(i)].name));
        txtadd(visn_tag, 'vpix_i18n_', get(vpix_gs_lang), '[', get(visn_tmp), '].value');
        txtadd(visn_tag_en, 'vpix_i18n_en[', get(visn_tmp), '].value');
        copy(visn_tmp_1, get(visn_tag));
        if (get(visn_tmp_1) === null,
          copy(vpix_i18n[get(i)].value, get(visn_tag_en));
        ,
          copy(vpix_i18n[get(i)].value, get(visn_tag));
        );
        if (layer[combobox],
          txtsplit(visn_tmp, '_', visn_tmp_1, visn_tmp_2);
          if (get(visn_tmp_1) == 'hs',
            txtadd(visn_tmp_3, 'cbo_', get(visn_tmp_2));
            txtadd(visn_tmp_4, 'act_change_scene_', get(visn_tmp_2));
            layer[combobox].addNamedItem(get(visn_tmp_3), get(vpix_i18n[get(i)].value), get(visn_tmp_4));
          );
        );
      );
      if (layer[combobox],
        txtsplit(xml.scene, '_', visn_tmp_1, visn_tmp_2);
        txtadd(visn_tmp_3, 'cbo_', get(visn_tmp_2));
        layer[combobox].selectItemByName(get(visn_tmp_3));
      );
      if (layer[vt_thumbs_holder], vt_act_language_changed(););
      if (layer[tour_map_holder], vtm_act_language_changed(););
      if (layer[vtmv_container], vtmv_act_language_changed(););
      if (layer[lyr_floor_plan], act_fp_language_changed(););
      if (layer[vtc_container], vtc_act_language_changed(););
    </action>

    <action name="act_change_language">
      set(vpix_gs_lang, %1);
      act_vpix_i18n_set_names();
    </action>

    <action name="vpix_open_url">
      if (vpix_gs_lang === null,
        txtsplit(get(vpix_info), '|', null, visn_tmp_1, visn_tmp_2);
        if (visn_tmp_2 == 0, openurl(get(visn_tmp_1), _blank);, openurl(get(visn_tmp_1), _self););
      ,
        txtadd(visn_tmp_1, 'data[', get(i18n_key), '_', get(vpix_gs_lang), '].content');
        copy(visn_tmp_3, get(visn_tmp_1));
        txtsplit(get(vpix_info), '|', null, null, visn_tmp_2);
        if (visn_tmp_2 == 0, openurl(get(visn_tmp_3), _blank);, openurl(get(visn_tmp_3), _self););
      );
    </action>

    <layer name="lyr_ask_gyro_holder" type="container" align="center" x="0" y="0"
        keep="true" visible="false" width="300" height="60"
        bgcolor="0xFFFFFF" bgroundedge="5" bgalpha="1.0" zorder="400">
      <layer name="lyr_ask_gyro_text" type="text" align="lefttop" x="15" y="17" bgalpha="0.8"
        width="120" height="28" html="[b]Enable Gyro?[/b]" padding="4"
        css="font-family:Sans-serif;font-size:16px;" />
      <layer name="lyr_ask_gyro_yes" type="text" align="lefttop" x="140" y="17" html="Yes" bgcolor="0x33FF33"
        width="60" height="28" padding="4" css="font-family:Sans-serif;font-size:16px;text-align:center;"
        bgroundedge="4" onclick="js(VpixTour.checkGyro(););set(layer[lyr_ask_gyro_holder].visible, false);" />
      <layer name="lyr_ask_gyro_no" type="text" align="lefttop" x="215" y="17" html="No" bgcolor="0xFF3333"
        width="60" height="28" padding="4" css="font-family:Sans-serif;font-size:16px;text-align:center;padding-top:2px;"
        bgroundedge="4" onclick="set(layer[lyr_ask_gyro_holder].visible, false);" />
    </layer>

    <include url="%CURRENTXML%/plugins/combobox.xml" if="only_scene.length == 0" />
</krpano>
