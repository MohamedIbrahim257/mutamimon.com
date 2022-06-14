<krpano>
    <action name="vpix_fp_init">
      if (%1 == null,
        set(plugin[pi_hide_floor_plan].align, 'lefttop');
        set(layer[lyr_floor_plan].vpix_position, 'lefttop');
      ,
        if (%1 == 'center',
          <!--
            2022-06-02: Even for center positioned floor plans we will slide
            in the floor plan from left side. x coordinate will be modified to
            position the floor plan in center.
          -->
          set(plugin[pi_hide_floor_plan].align, 'lefttop');
          set(layer[lyr_floor_plan].align, 'lefttop');
          set(layer[pi_fp_combo].align, 'lefttop');
        ,
          set(plugin[pi_hide_floor_plan].align, %1);
          set(layer[lyr_floor_plan].align, %1);
          set(layer[pi_fp_combo].align, %1);
        );
        set(layer[lyr_floor_plan].vpix_position, %1);
      );
      set(plugin[pi_hide_floor_plan].orig_visible, get(plugin[pi_hide_floor_plan].visible));
    </action>

    <action name="act_fp_add_to_combo" scope="local">
      if (vpix_floor_plan.count GT 1,
        layer[pi_fp_combo].removeAll();
        layer[pi_fp_combo].addNamedItem(0, --Select--, "");
        for(set(i,0), i LT vpix_floor_plan.count, inc(i),
          set(local.vpix_fp_cbo_id, get(vpix_floor_plan[get(i)].cbo_id));
          set(local.vpix_fp_name, get(vpix_floor_plan[get(i)].name));
          if (vpix_gs_lang === null,
            set(local.vpix_fp_desc, get(vpix_floor_plan[get(i)].description));
          ,
            txtsplit(get(vpix_fp_name), '_', null, vpix_fp_tmp1);
            txtadd(vpix_fp_tmp2, 'fpi_', get(vpix_fp_tmp1));
            set(local.vpix_fp_desc, get(vpix_i18n[get(vpix_fp_tmp2)].value));
          );
          txtadd(local.vpix_fp_action, 'act_fp_activate(', get(vpix_fp_name), ');');
          layer[pi_fp_combo].addNamedItem(get(vpix_fp_cbo_id), get(vpix_fp_desc), get(vpix_fp_action));
        );
      );
    </action>

    <action name="act_set_default_fp">
        set(curr_fp, %1);
        set(layer[lyr_floor_plan].current_floor_plan, %1);
    </action>
    <action name="act_floor_plan_change">
      set(layer[lyr_floor_plan].current_spot, %2);
      if (vpix_floor_plan.count GT 1,
        layer[pi_fp_combo].selectItemByName(get(vpix_floor_plan[%1].cbo_id));
      );
      if (layer[lyr_floor_plan].visible,
        if (layer[lyr_floor_plan].current_floor_plan == %1,
          act_fp_reposition_radar(%2);
        ,
          act_set_default_fp(%1);
          act_floor_plan_show();
        );
      ,
        act_set_default_fp(%1);
      );
    </action>
    <action name="act_floor_plan_show" scope="local">
        act_calc_fp_positions(get(vpix_floor_plan[%curr_fp].width), get(vpix_floor_plan[%curr_fp].height));
        tween(plugin[pi_show_floor_plan].alpha, 0.00, 0.5, default);
        set(plugin[pi_hide_floor_plan].visible, true);
        set(plugin[pi_hide_floor_plan].orig_visible, true);
        sub(local.vpix_fp_tmp1, global.vpix_fp_y, 10);
        set(plugin[pi_hide_floor_plan].y, get(vpix_fp_tmp1));
        sub(vpix_fp_tmp1, vpix_fp_width, 10);
        sub(local.vpix_fp_tmp2, 0, get(vpix_fp_width));
        sub(local.vpix_fp_tmp2, vpix_fp_x);
        set(layer[lyr_floor_plan].visible, false);
        set(layer[lyr_floor_plan].orig_visible, false);
        set(layer[lyr_floor_plan].y, get(vpix_fp_y));
        set(layer[lyr_floor_plan].x, get(vpix_fp_tmp2));
        set(layer[lyr_floor_plan].url, get(vpix_floor_plan[%curr_fp].url));
        set(layer[lyr_floor_plan].width, get(vpix_fp_width));
        set(layer[lyr_floor_plan].height, get(vpix_fp_height));
        add(vpix_fp_tmp1, vpix_fp_x);
        tween(plugin[pi_hide_floor_plan].x, get(vpix_fp_tmp1), 0.5, default);
        set(layer[lyr_floor_plan].visible, true);
        set(layer[lyr_floor_plan].orig_visible, true);
        tween(layer[lyr_floor_plan].x, get(vpix_fp_x), 0.5, default);
        if (vpix_floor_plan.count GT 1,
          sub(vpix_fp_tmp2, vpix_fp_y, 30);
          set(layer[pi_fp_combo].y, get(vpix_fp_tmp2));
          set(layer[pi_fp_combo].visible, true);
          set(layer[pi_fp_combo].orig_visible, true);
        );
        act_floor_plan_remove_spots();
        act_floor_plan_add_spots();
        act_fp_reposition_radar(get(layer[lyr_floor_plan].current_spot));
    </action>
    <!--
      %1 = notween
      If true, hide the floor plan immediately without animation.
      If false or not set, tween and hide.
    -->
    <action name="act_floor_plan_hide" scope="local">
        tween(plugin[pi_show_floor_plan].alpha, 1.00. 0.5, default);
        set(layer[pi_fp_radar].visible, false);
        sub(local.vpix_fp_tmp1, 0, get(layer[lyr_floor_plan].width));
        sub(vpix_fp_tmp1, 10);
        if (%1 === true,
          set(plugin[pi_hide_floor_plan].x, get(vpix_fp_tmp1));
          set(plugin[pi_hide_floor_plan].visible, false);set(plugin[pi_hide_floor_plan].orig_visible, false);
          set(layer[lyr_floor_plan].x, get(vpix_fp_tmp1));
          set(layer[lyr_floor_plan].visible, false);set(layer[lyr_floor_plan].orig_visible, false);
        ,
          tween(
            plugin[pi_hide_floor_plan].x,
            get(vpix_fp_tmp1),
            1,
            default,
            set(plugin[pi_hide_floor_plan].visible, false);set(plugin[pi_hide_floor_plan].orig_visible, false);
          );
          tween(
            layer[lyr_floor_plan].x,
            get(vpix_fp_tmp1),
            0.5,
            default,
            set(layer[lyr_floor_plan].visible, false);set(layer[lyr_floor_plan].orig_visible, false);
          );
        );
        set(layer[pi_fp_combo].visible, false);
        set(layer[pi_fp_combo].orig_visible, false);
    </action>

    <action name="act_hide_fp_radar">
      set(layer[lyr_floor_plan].current_spot, '');
      set(layer[pi_fp_radar].visible, false);
      set(layer[pi_fp_radar].is_attached_to_pano, false);
    </action>
    <action name="act_calc_fp_positions" scope="local">
      mul(local.vpix_fp_tmp1, stagewidth, 0.8);
      Math.round(vpix_fp_tmp1);
      mul(local.vpix_fp_tmp2, stageheight, 0.9);
      Math.round(vpix_fp_tmp2);
      if (vpix_floor_plan.count GT 1, sub(vpix_fp_tmp2, 22));
      if (%1 GT vpix_fp_tmp1 OR %2 GT vpix_fp_tmp2,
        div(local.vpix_fp_stage_scale, vpix_fp_tmp1, get(vpix_fp_tmp2));
        div(local.vpix_fp_fp_scale, %1, %2);
        if (vpix_fp_stage_scale GT vpix_fp_fp_scale,
          copy(global.vpix_fp_height, vpix_fp_tmp2);
          mul(global.vpix_fp_width, %1, get(vpix_fp_tmp2));
          div(global.vpix_fp_width, %2);
          Math.round(global.vpix_fp_width);
        ,
          copy(global.vpix_fp_width, vpix_fp_tmp1);
          mul(global.vpix_fp_height, %2, get(vpix_fp_tmp1));
          div(global.vpix_fp_height, %1);
          Math.round(global.vpix_fp_height);
        );
      ,
        set(global.vpix_fp_width, %1);
        set(global.vpix_fp_height, %2);
      );
      sub(global.vpix_fp_y, stageheight, get(vpix_fp_height));
      div(global.vpix_fp_y, 2);
      Math.round(global.vpix_fp_y);
      if (layer[lyr_floor_plan].vpix_position == 'center',
        sub(global.vpix_fp_x, stagewidth, get(vpix_fp_width));
        div(global.vpix_fp_x, 2);
        Math.round(global.vpix_fp_x);
        div(layer[pi_fp_combo].x, stagewidth, 2);
        Math.round(layer[pi_fp_combo].x);
        div(vpix_fp_tmp1, layer[pi_fp_combo].width, 2);
        Math.round(vpix_fp_tmp1);
        sub(layer[pi_fp_combo].x, vpix_fp_tmp1);
      ,
        set(global.vpix_fp_x, 0);
      );
    </action>

    <action name="act_floor_plan_remove_spots">
      for(set(i, 0), i LT vpix_scene_spot.count, inc(i),
        set(fps_name, get(vpix_scene_spot[get(i)].name));
        if (layer[%fps_name], removelayer(get(fps_name)););
      );
      for(set(i, 0), i LT vpix_url_spot.count, inc(i),
        set(fps_name, get(vpix_url_spot[get(i)].name));
        if (layer[%fps_name], removelayer(get(fps_name)););
      );
    </action>

    <action name="act_floor_plan_add_spots">
      for(set(i, 0), i LT vpix_scene_spot.count, inc(i),
        if (vpix_scene_spot[get(i)].floor_plan == curr_fp,
          if (vpix_gs_lang === null,
            set(vpix_fp_tmp3, get(vpix_scene_spot[get(i)].onhover));
          ,
            txtsplit(get(vpix_scene_spot[get(i)].name), '_', null, vpix_fp_tmp1);
            txtadd(vpix_fp_tmp2, 'hs_', get(vpix_fp_tmp1));
            txtadd(vpix_fp_tmp3, 'showtext(', get(vpix_i18n[get(vpix_fp_tmp2)].value), ');');
          );
          act_floor_plan_add_spot(
            get(vpix_scene_spot[get(i)].name),
            get(vpix_scene_spot[get(i)].floor_plan),
            get(vpix_scene_spot[get(i)].url),
            get(vpix_scene_spot[get(i)].width),
            get(vpix_scene_spot[get(i)].height),
            get(vpix_scene_spot[get(i)].x),
            get(vpix_scene_spot[get(i)].y),
            get(vpix_fp_tmp3),
            get(vpix_scene_spot[get(i)].action)
          );
          act_fp_add_heading(
            get(vpix_scene_spot[get(i)].name),
            get(vpix_scene_spot[get(i)].heading)
          );
        );
      );
      for(set(i, 0), i LT vpix_url_spot.count, inc(i),
        if (vpix_url_spot[get(i)].floor_plan == curr_fp,
          if (vpix_gs_lang === null,
            set(vpix_fp_tmp2, get(vpix_url_spot[get(i)].onhover));
          ,
            set(vpix_fp_tmp1, get(vpix_url_spot[get(i)].name));
            txtadd(vpix_fp_tmp2, 'showtext(', get(vpix_i18n[get(vpix_fp_tmp1)].value), ');');
          );
          act_floor_plan_add_spot(
            get(vpix_url_spot[get(i)].name),
            get(vpix_url_spot[get(i)].floor_plan),
            get(vpix_url_spot[get(i)].url),
            get(vpix_url_spot[get(i)].width),
            get(vpix_url_spot[get(i)].height),
            get(vpix_url_spot[get(i)].x),
            get(vpix_url_spot[get(i)].y),
            get(vpix_fp_tmp2),
            get(vpix_url_spot[get(i)].onclick)
          );
        );
      );
    </action>

    <action name="act_floor_plan_add_spot" scope="local">
      addlayer(%1);
      set(layer[%1].url, %3);
      set(layer[%1].align, 'lefttop');
      set(layer[%1].edge, 'center');
      set(layer[%1].zorder, 110);
      set(layer[%1].width, %4);
      set(layer[%1].height, %5);
      set(layer[%1].onhover, %8);
      set(layer[%1].onclick, %9);
      mul(local.vpix_fp_tmp1, get(layer[lyr_floor_plan].width), %6);
      div(vpix_fp_tmp1, get(vpix_floor_plan[%2].width));
      Math.round(vpix_fp_tmp1);
      mul(local.vpix_fp_tmp2, get(layer[lyr_floor_plan].height), %7);
      div(vpix_fp_tmp2, get(vpix_floor_plan[%2].height));
      Math.round(vpix_fp_tmp2);
      set(layer[%1].x, get(vpix_fp_tmp1));
      set(layer[%1].y, get(vpix_fp_tmp2));
      set(layer[%1].visible, true);
      set(layer[%1].keep, true);
      set(layer[%1].enabled, true);
      set(layer[%1].parent, 'layer[lyr_floor_plan]');
    </action>
    <action name="act_fp_add_heading">
      set(layer[%1].heading, %2);
    </action>

    <action name="act_fp_activate" scope="local">
      if(curr_fp != %1,
        act_set_default_fp(%1);
        act_floor_plan_show();
        act_id_from_scene_name(get(xml.scene), local.vpix_fp_tmp1);
        <!--
        If current scene has spot on the activated floor plan, set radar to it,
        otherwise hide the radar.
        -->
        txtadd(local.vpix_fp_tmp2, 'fps_', get(vpix_fp_tmp1));
        if (layer[get(vpix_fp_tmp2)] === null,
          act_hide_fp_radar();
        ,
          set(layer[lyr_floor_plan].current_spot, get(vpix_fp_tmp2));
          act_fp_reposition_radar(get(vpix_fp_tmp2));
        );
      );
    </action>

    <action name="act_fp_reposition_radar">
      indexoftxt(vpix_fp_tmp1, %1, 'fps_');
      if (vpix_fp_tmp1 LT 0,
        set(layer[pi_fp_radar].visible, false);
      ,
        set(layer[pi_fp_radar].x, get(layer[%1].x));
        set(layer[pi_fp_radar].y, get(layer[%1].y));
        set(layer[pi_fp_radar].heading, get(layer[%1].heading));
        set(layer[pi_fp_radar].visible, true);
      );
    </action>

    <action name="act_fp_window_resized" scope="local">
      ifnot (plugin[webvr] AND plugin[webvr].isenabled,
        act_is_small_screen(local.vpix_fp_tmp1);
        <!-- all plugins, hotspots and layers should be hidden, when only_scene is set. -->
        if (vpix_fp_tmp1 OR only_scene,
          set(layer[lyr_floor_plan].visible, false);
          set(layer[pi_fp_combo].visible, false);
          set(plugin[pi_show_floor_plan].visible, false);
          set(plugin[pi_hide_floor_plan].visible, false);
        ,
          set(plugin[pi_show_floor_plan].visible, true);
          set(layer[lyr_floor_plan].visible, get(layer[lyr_floor_plan].orig_visible));
          set(layer[pi_fp_combo].visible, get(layer[pi_fp_combo].orig_visible));
          set(plugin[pi_hide_floor_plan].visible, get(plugin[pi_hide_floor_plan].orig_visible));
        );
        if (layer[lyr_floor_plan].visible,
          act_calc_fp_positions(get(vpix_floor_plan[%curr_fp].width), get(vpix_floor_plan[%curr_fp].height));
          sub(vpix_fp_tmp1, vpix_fp_y, 10);
          set(plugin[pi_hide_floor_plan].y, get(vpix_fp_tmp1));
          sub(vpix_fp_tmp1, vpix_fp_width, 10);
          add(vpix_fp_tmp1, vpix_fp_x);
          set(plugin[pi_hide_floor_plan].x, get(vpix_fp_tmp1));
          set(layer[lyr_floor_plan].width, get(vpix_fp_width));
          set(layer[lyr_floor_plan].height, get(vpix_fp_height));
          set(layer[lyr_floor_plan].y, get(vpix_fp_y));
          set(layer[lyr_floor_plan].x, get(vpix_fp_x));
          if (vpix_floor_plan.count GT 1,
            sub(local.vpix_fp_tmp2, vpix_fp_y, 30);
            set(layer[pi_fp_combo].y, get(vpix_fp_tmp2));
            div(layer[pi_fp_combo].x, stagewidth, 2);
            Math.round(layer[pi_fp_combo].x);
            div(vpix_fp_tmp1, layer[pi_fp_combo].width, 2);
            Math.round(vpix_fp_tmp1);
            sub(layer[pi_fp_combo].x, vpix_fp_tmp1);
          );
          act_fp_reposition_spots();
          if (layer[lyr_floor_plan].current_spot,
            act_fp_reposition_radar(get(layer[lyr_floor_plan].current_spot));
          );
        );
      );
    </action>

    <action name="act_fp_reposition_spots" scope="local">
      for(set(i, 0), i LT vpix_scene_spot.count, inc(i),
        if (vpix_scene_spot[get(i)].floor_plan == curr_fp,
          mul(local.vpix_fp_tmp1, get(layer[lyr_floor_plan].width), get(vpix_scene_spot[get(i)].x));
          div(vpix_fp_tmp1, get(vpix_floor_plan[%curr_fp].width));
          Math.round(vpix_fp_tmp1);
          mul(local.vpix_fp_tmp2, get(layer[lyr_floor_plan].height), get(vpix_scene_spot[get(i)].y));
          div(vpix_fp_tmp2, get(vpix_floor_plan[%curr_fp].height));
          Math.round(vpix_fp_tmp2);
          set(fps_name, get(vpix_scene_spot[get(i)].name));
          set(layer[get(fps_name)].x, get(vpix_fp_tmp1));
          set(layer[get(fps_name)].y, get(vpix_fp_tmp2));
        );
      );
      for(set(i, 0), i LT vpix_url_spot.count, inc(i),
        if (vpix_url_spot[get(i)].floor_plan == curr_fp,
          mul(local.vpix_fp_tmp1, get(layer[lyr_floor_plan].width), get(vpix_url_spot[get(i)].x));
          div(vpix_fp_tmp1, get(vpix_floor_plan[%curr_fp].width));
          Math.round(vpix_fp_tmp1);
          mul(local.vpix_fp_tmp2, get(layer[lyr_floor_plan].height), get(vpix_url_spot[get(i)].y));
          div(vpix_fp_tmp2, get(vpix_floor_plan[%curr_fp].height));
          Math.round(vpix_fp_tmp2);
          set(fps_name, get(vpix_url_spot[get(i)].name));
          set(layer[get(fps_name)].x, get(vpix_fp_tmp1));
          set(layer[get(fps_name)].y, get(vpix_fp_tmp2));
        );
      );
    </action>

    <action name="act_fp_language_changed" scope="local">
      act_fp_add_to_combo();
      if (curr_fp !== null,
        layer[pi_fp_combo].selectItemByName(get(vpix_floor_plan[%curr_fp].cbo_id));
      );
      if (layer[lyr_floor_plan].visible == true,
        set(layer[pi_fp_combo].visible, true);
      ,
        <!--
          2022-01-08: Not sure why, how or where but visibility of pi_fp_combo is being
          set to 'true' even after being set to 'false' here.
          If we set it to 'false' again in a 'delayedcall', it appears briefly before
          becoming invisible. To avoid that, x co-ordinate is changed so that floor
          plan does not appear even if visibility gets changed to true. In the
          delayedcall, we will set visibility to false and revert back the x coordinate value.
        -->
        set(layer[pi_fp_combo].visible, false);
        set(local.vpix_fp_tmp1, get(layer[pi_fp_combo].x));
        set(layer[pi_fp_combo].x, -500);
        delayedcall(1.0, set(layer[pi_fp_combo].visible, false); set(layer[pi_fp_combo].x, get(local.vpix_fp_tmp1)););
      );

      for(set(i, 0), i LT vpix_scene_spot.count, inc(i),
        if (vpix_scene_spot[get(i)].floor_plan == curr_fp,
          txtsplit(get(vpix_scene_spot[get(i)].name), '_', null, vpix_fp_tmp1);
          txtadd(vpix_fp_tmp2, 'hs_', get(vpix_fp_tmp1));
          txtadd(vpix_fp_tmp3, 'showtext(', get(vpix_i18n[get(vpix_fp_tmp2)].value), ');');
          set(layer[get(vpix_scene_spot[get(i)].name)].onhover, get(vpix_fp_tmp3));
        );
      );

      for(set(i, 0), i LT vpix_url_spot.count, inc(i),
        if (vpix_url_spot[get(i)].floor_plan == curr_fp,
          set(vpix_fp_tmp1, get(vpix_url_spot[get(i)].name));
          txtadd(vpix_fp_tmp2, 'showtext(', get(vpix_i18n[get(vpix_fp_tmp1)].value), ');');
          set(layer[get(vpix_fp_tmp1)].onhover, get(vpix_fp_tmp2));
        );
      );
    </action>

    <layer name="lyr_floor_plan" url="%CURRENTXML%/assets/images/empty_1x1.png"
        zorder="8" align="lefttop" x="0" y="0" children="true" width="1" height="1"
        keep="true" enabled="true" capture="true" visible="false" orig_visible="false"
        current_floor_plan="" current_spot=""
        />

    <layer name="pi_fp_radar" url="%CURRENTXML%/plugins/radar.swf" alturl="%CURRENTXML%/plugins/radar.js"
        align="lefttop" edge="center" zorder="100" visible="false" enabled="true"
        keep="true" capture="true" width="100" height="100" is_attached_to_pano="false" 
        linewidth="1" fillcolor="0xFF9999" fillalpha="0.5"
        parent="layer[lyr_floor_plan]" behindspots="true"
        />

    <!--
      y = -40. Combobox is visible on tour start. Can't find where visibility is
      being set to true. To avoid that, it is being hidden, so to speak, by setting
      a negative value to y.
      When floor plan is shown, it will come up where it should.
    -->
    <combobox name="pi_fp_combo" align="lefttop" x="35" y="-40" width="150"
           keep="true" alpha="1.0" visible="false" rowcount="10" design="default"
           zorder="28" onloaded="act_fp_add_to_combo();" orig_visible="false"></combobox>

    <events name="vpix_fp_events" onresize="act_fp_window_resized();" keep="true" />
</krpano>
