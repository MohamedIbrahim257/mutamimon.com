<krpano>
    <action name="act_remove_img_attribute">
      indexoftxt(spos, get(%2), %3, %4);
      if (spos GT -1 AND spos LT %5,
        indexoftxt(epos, get(%2), ' ', get(spos));
        sub(len, epos, spos);
        subtxt(search, get(%2), get(spos), get(len));
        txtreplace(%1, %2, get(search), '');
      ,
        set(%1, get(%2));
      );
    </action>
    <action name="act_remove_img_width_height">
      set(content, get(data[%1].content));
      indexoftxt(img_spos, get(content), '[img', 1);
      indexoftxt(img_epos, get(content), ']', get(img_spos));
      act_remove_img_attribute(modified_content, content, 'width=', get(img_spos), get(img_epos));
      act_remove_img_attribute(modified_content, modified_content, 'height=', get(img_spos), get(img_epos));
      act_remove_img_attribute(modified_content, modified_content, 'hspace=', get(img_spos), get(img_epos));
      act_remove_img_attribute(modified_content, modified_content, 'vspace=', get(img_spos), get(img_epos));
      set(data[%1].content, get(modified_content));
    </action>

    <action name="act_show_info_flexible" scope="local">
      js(VpixTracker.infoboxHotspotClicked(%1););
      set(layer[vpix_ib_overlay].vpix_info, %1);

      if (%2 == 1,
        vpix_ib_act_black_box();
      , if (%2 == 2, vpix_ib_act_white_box();, vpix_ib_act_custom_style(%2););
      );
      set(vib_tmp_url, get(data[%1].img_url));
      if (vib_tmp_url !== null,
        vpix_ib_act_box_dimensions(get(data[%1].width), get(data[%1].height), 0.80, vib_box_width, vib_box_height);
        mul(vib_tmp_1, stagewidth, 0.10);
        roundval(vib_tmp_1);
        if (vib_box_width LE vib_tmp_1,
          txtadd(vib_html, '[img src="', get(vib_tmp_url), '" style="float:left;width:', get(data[%1].width), 'px;height:', get(data[%1].height), 'px;margin:0px 4px 4px 0px;" /]');
          mul(vib_stage_width, stagewidth, 0.50);
          roundval(vib_stage_width);
        ,
          txtadd(vib_html, '[img src="', get(vib_tmp_url), '" style="width:', get(vib_box_width), 'px;height:', get(vib_box_height), 'px;margin:0px 0px 4px 0px;" /]');
          set(vib_stage_width, get(vib_box_width));
        );
        add(vib_stage_width, 8);
        add(vib_stage_width, 20);
        if (vpix_gs_lang === null,
          txtsplit(get(data[%1].content), '[div]', null, vib_tmp_2);
        ,
          txtadd(vib_tmp_3, %1, '_', get(vpix_gs_lang));
          txtsplit(get(data[%vib_tmp_3].content), '[div]', null, vib_tmp_2);
        );
        txtadd(vib_html, '[div]', get(vib_html), get(vib_tmp_2));
        set(plugin[vpix_ib_text].html, get(vib_html));
        vpix_ib_act_show_1(get(vib_stage_width));
      ,
        if (stagewidth LT 420,
          mul(vib_box_width, stagewidth, 0.8):
        ,
          if (stagewidth LT 720, set(vib_box_width, 500);, set(vib_box_width, 600););
        );
        if (vpix_gs_lang === null,
          set(plugin[vpix_ib_text].html, get(data[%1].content));
        ,
          txtadd(vib_tmp_3, %1, '_', get(vpix_gs_lang));
          set(plugin[vpix_ib_text].html, get(data[%vib_tmp_3].content));
        );
        vpix_ib_act_show_1(get(vib_box_width));
      );
    </action>

    <action name="act_show_info" scope="local">
        js(VpixTracker.infoboxHotspotClicked(%1););
        set(layer[vpix_ib_overlay].vpix_info, %1);

        if (%2 == 1,
          vpix_ib_act_black_box();
        , if (%2 == 2, vpix_ib_act_white_box();, vpix_ib_act_custom_style(get(%2)););
        );
        if (%3 == null, set(vib_box_width, 310);, set(vib_box_width, %3););
        add(vib_box_width, 4);
        mul(vib_tmp, stagewidth, 0.8);
        if (vib_box_width GT vib_tmp, set(vib_box_width, get(vib_tmp)););
        if (vpix_gs_lang === null,
          set(plugin[vpix_ib_text].html, get(data[%1].content));
        ,
          txtadd(vib_tmp_3, %1, '_', get(vpix_gs_lang));
          set(plugin[vpix_ib_text].html, get(data[%vib_tmp_3].content));
        );
        vpix_ib_act_show_1(get(vib_box_width));
    </action>
    <action name="act_show_image_info_box" scope="local">
        js(VpixTracker.infoboxHotspotClicked(%1););
        set(layer[vpix_ib_overlay].vpix_info, %1);

        vpix_ib_act_image_box();
        act_remove_img_width_height(%1);
        vpix_ib_act_box_dimensions(%2, %3, 0.80, vib_box_width, vib_box_height);
        txtsplit(get(data[%1].content), '/]', vib_tmp, null);
        txtadd(vib_tmp, get(vib_tmp), ' width="', get(vib_box_width), 'px" height="', get(vib_box_height), 'px" /]');
        vpix_ib_act_show(get(vib_tmp), get(vib_box_width), get(vib_box_height));
    </action>

    <action name="vpix_ib_act_box_dimensions" scope="local">
        set(local.pitfw, %1);
        set(local.pitfh, %2);
        mul(local.sw, stagewidth, 0.80);
        mul(local.sh, stageheight, %3);
        roundval(sw);
        roundval(sh);
        if (pitfw GT sw OR pitfh GT sh,
          div(local.stageaspect, sw, sh);
          div(local.imageaspect, %1,  %2);
          if (stageaspect GT imageaspect,
            set(pitfh, get(sh));
            mul(pitfw,  pitfw, get(sh));
            div(pitfw, pitfw, %2);
          ,
            set(pitfw, get(sw));
            mul(pitfh, pitfh, get(sw));
            div(pitfh, pitfh, %1);
          );
        ,
          mul(pitfw, %1, 0.80);
          mul(pitfh, %2, %3);
        );
        roundval(pitfw);
        roundval(pitfh);
        parentscopeset(%4, get(pitfw));
        parentscopeset(%5, get(pitfh));
    </action>

    <action name="vpix_ib_act_show" scope="local">
        set(plugin[pi_overlay].visible, false);
        set(plugin[vpix_ib_text].html, %1);
        set(plugin[vpix_ib_text].width, %2);
        set(layer[vpix_ib_scroller].width, %2);
        set(layer[vpix_ib_scroller].x, 0);
        set(layer[vpix_ib_scroller].y, 0);
        delayedcall(0.5,
          set(plugin[vpix_ib_text].visible, true);
          set(layer[vpix_ib_scroller].visible, true);
          set(layer[vpix_ib_overlay].visible, true);
          if (%3 != null, set(plugin[vpix_ib_text].height, %3));
          vpix_ib_act_show_message();
        );
    </action>

    <!--
      2020-04-15:
      Using the vpix_ib_act_show by passing the html as the first argument is
      leading to blank text areas when html content contains comma(s) with
      krpano 1.20.4. Not sure about the reason. May be some parsing errors with
      the new version. This did not happen when value was set through javascript.
      So, instead of storing the html into a variable and then passing it as
      argument to the function to be set into the vpix_ib_text, html is set
      directly into vpix_ib_text and then this function is called to set the
      visibilities etc.
    -->
    <action name="vpix_ib_act_show_1" scope="local">
        set(plugin[pi_overlay].visible, false);
        set(plugin[vpix_ib_text].width, %1);
        set(plugin[vpix_ib_text].padding, 10);
        set(layer[vpix_ib_scroller].width, %1);
        set(layer[vpix_ib_scroller].x, 0);
        set(layer[vpix_ib_scroller].y, 0);
        delayedcall(0.5,
          set(plugin[vpix_ib_text].visible, true);
          set(layer[vpix_ib_scroller].visible, true);
          set(layer[vpix_ib_overlay].visible, true);
          vpix_ib_act_show_message();
        );
    </action>

    <action name="vpix_ib_act_hide">
        set(plugin[vpix_ib_text].visible, false);
        set(layer[vpix_ib_scroller].visible, false);
        set(layer[vpix_ib_overlay].visible, false);
        set(layer[vpix_ib_text].html, '');
        vpix_ib_act_hide_message();
        js(VpixTracker.infoboxClosed(get(layer[vpix_ib_overlay].vpix_info)););
        set(layer[vpix_ib_overlay].vpix_info, null);
    </action>

    <action name="vpix_ib_act_white_box">
        set(plugin[vpix_ib_text].autoheight, true);
        set(plugin[vpix_ib_text].bordercolor, 0x000000);
        set(plugin[vpix_ib_text].backgroundcolor, 0xFFFFFF);
        set(plugin[vpix_ib_text].css, 'div{font-family:Trebuchet,Verdana,Sans-serif;font-size:14px;box-sizing:border-box;padding:4px;}p{color:#000000;margin-bottom:5px;}a{color:#0000FF;margin-right:5px;}');
    </action>
    <action name="vpix_ib_act_black_box">
        set(plugin[vpix_ib_text].autoheight, true);
        set(plugin[vpix_ib_text].bordercolor, 0xFFFFFF);
        set(plugin[vpix_ib_text].backgroundcolor, 0x000000);
        set(plugin[vpix_ib_text].css, 'div{font-family:Trebuchet,Verdana,Sans-serif;font-size:14px;box-sizing:border-box;padding:4px;}p{color:#FFFFFF;margin-bottom:5px;}a{color:#FAAC58;margin-right:5px;}');
    </action>
    <action name="vpix_ib_act_custom_style">
        set(plugin[vpix_ib_text].autoheight, true);
        set(plugin[vpix_ib_text].bordercolor, 0xFFFFFF);
        txtadd(vib_tmp, '0x', get(vpix_infobox_style[%1].background_color));
        set(plugin[vpix_ib_text].backgroundcolor, get(vib_tmp));
        txtadd(vib_tmp, 'div{font-family:', get(vpix_infobox_style[%1].font_family), ';font-size:14px;box-sizing:border-box;padding:4px;}p{color:#', get(vpix_infobox_style[%1].color), ';margin-bottom:5px;}a{margin-right:5px;}');
        set(plugin[vpix_ib_text].css, get(vib_tmp));
    </action>
    <action name="vpix_ib_act_image_box">
        set(plugin[vpix_ib_text].padding, 0);
        set(plugin[vpix_ib_text].backgroundcolor, 0xFFFFFF);
        set(plugin[vpix_ib_text].autoheight, false);
        set(plugin[vpix_ib_text].css, 'div{box-sizing:border-box;padding:4px;text-align:center;margin:0px;border-width:0px;}img{padding:0px;margin:0px;border-width:0px;}');
    </action>

    <action name="vpix_ib_act_show_message">
        set(plugin[vpix_ib_message].visible, true);
        delayedcall(10.0, vpix_ib_act_hide_message(););
    </action>
    <action name="vpix_ib_act_hide_message">
        set(plugin[vpix_ib_message].visible, false);
    </action>

    <plugin name="vpix_ib_message" url="%CURRENTXML%/plugins/textfield.swf"
        align="top" x="0" y="10" html="[div]Click anywhere outside the box to close[/div]"
        keep="true" visible="false" padding="0" autowidth="false" autoheight="true"
        zorder="212" bgroundedge="4" selectable="false"
        border="true" borderwidth="2" bordercolor="0x999999" borderalpha="1.0"
        backgroundcolor="0x000000" backgroundalpha="0.75" width="320"
        css="div{font-family:Verdana,Sans-serif;font-size:16px;padding:4px 8px;color:#FFFFFF;text-align:center;}"
        onclick="vpix_ib_act_hide_message" />

    <plugin name="vpix_ib_text" url="%CURRENTXML%/plugins/textfield.swf"
        align="center" x="0" y="0" html="" keep="true" visible="false"
        padding="0" autoheight="true" autowidth="false" zorder="211" bgroundedge="4"
        selectable="false" border="true" borderwidth="2" bordercolor="0xCCCCCC" borderalpha="1.0"
        parent="layer[vpix_ib_scroller]" onautosized="copy(layer[vpix_ib_scroller].height, height);"
        />

    <layer name="vpix_ib_scroller" url="%CURRENTXML%/plugins/scrollarea.swf" alturl="%CURRENTXML%/plugins/scrollarea.js"
        align="center" x="0" y="0" keep="true" visible="false" zorder="211" direction="v" />

    <layer name="vpix_ib_overlay" type="container" width="100%" height="100%"
        bgcapture="true" bgcolor="0x000000" bgalpha="0.70" zorder="210"
        keep="true" visible="false" onclick="vpix_ib_act_hide();" />
</krpano>
