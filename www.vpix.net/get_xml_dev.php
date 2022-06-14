<krpano version="1.20" onstart="action(start_tour); " showerrors="false" logkey="false">

<include url="%CURRENTXML%/global_xml.php" />

<include url="%CURRENTXML%/plugins/showtext.xml" devices="html5" />

<include url="%CURRENTXML%/vpix_plugin.php?xml=vpix_common.xml" />


	<action name="start_tour_normal">
		set(vpix_gs_first_scene, true);
		set(vpix_pan_like_google, '-1');
		vpix_fp_init();
    set(glst_auto_rotate, true);

		act_set_default_fp(fpi_5596);

		delayedcall(0.5, act_delayed_start(act_change_scene_363748, true););
		act_init_last();
	</action>

	<action name="act_vpix_init_gs">
	</action>
<action name="act_change_scene_363746">
    act_load_scene(sc_363746_gameroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363746);
	act_floor_plan_change(fpi_5598, fps_363746);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363747">
    act_load_scene(sc_363747_frontlobbysm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363747);
	act_floor_plan_change(fpi_5596, fps_363747);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363748">
    act_load_scene(sc_363748_frontelevationsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363748);
	act_floor_plan_change(fpi_5596, fps_363748);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363749">
    act_load_scene(sc_363749_bedroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363749);
	act_floor_plan_change(fpi_5597, fps_363749);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363750">
    act_load_scene(sc_363750_bedroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363750);
	act_floor_plan_change(fpi_5597, fps_363750);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363751">
    act_load_scene(sc_363751_livingroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363751);
	act_floor_plan_change(fpi_5596, fps_363751);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363752">
    act_load_scene(sc_363752_masterbathroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363752);
	act_floor_plan_change(fpi_5597, fps_363752);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363753">
    act_load_scene(sc_363753_masterbedroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363753);
	act_floor_plan_change(fpi_5597, fps_363753);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363754">
    act_load_scene(sc_363754_gameroomsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363754);
	act_floor_plan_change(fpi_5598, fps_363754);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363755">
    act_load_scene(sc_363755_upstairslandingsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363755);
	act_floor_plan_change(fpi_5597, fps_363755);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363756">
    act_load_scene(sc_363756_outdoorpatiosm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363756);
	act_floor_plan_change(fpi_5596, fps_363756);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363757">
    act_load_scene(sc_363757_masterclosetsm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363757);
	act_floor_plan_change(fpi_5597, fps_363757);
    vpix_act_scene_changed();
</action>
<action name="act_change_scene_363758">
    act_load_scene(sc_363758_kitchensm, null, %1, %2, %3);
    layer[combobox].selectItemByName(cbo_363758);
	act_floor_plan_change(fpi_5596, fps_363758);
    vpix_act_scene_changed();
</action>
    <autorotate    enabled="true" waittime="2.0" speed="4" horizon="0" />
    <plugin name="pi_rotate" url="%CURRENTXML%/assets/resume-rotation.png" 
            align="leftbottom" x="60" y="20" width="40" height="40" 
            keep="true" alpha="0.75" blendmode="normal" 
            onhover="showtext(Autorotate on/off);" 
            onclick="act_autorotate_clicked();" 
            /> 

	<scene name="sc_363748_frontelevationsm" title="Front Elevation" start_hlookat="-83.55373174776612" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363748_frontelevationsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="-83.55373174776612" vlookat="3.6738976363503832" fovtype="MFOV" fov="104" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363748_frontelevationsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363748_frontelevationsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363748_frontelevationsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>    <hotspot name="hs_363747_frontlobbysm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-91.23676634807032" atv="-9.33298801659766" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Front Lobby, fs_helvetica)" onclick="lookto(-91.23676634807032, get(view.vlookat), get(view.fov));act_change_scene_363747();"/>
	</scene>

	<scene name="sc_363747_frontlobbysm" title="Front Lobby" start_hlookat="-33.02954917652124" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363747_frontlobbysm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="-33.02954917652124" vlookat="0.2884932080116349" fovtype="MFOV" fov="110" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363747_frontlobbysm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363747_frontlobbysm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363747_frontlobbysm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363748_frontelevationsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="125.4671855485608" atv="5.717210669738816" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Front Elevation, fs_helvetica)" onclick="lookto(125.4671855485608, get(view.vlookat), get(view.fov));act_change_scene_363748();"/>
    <hotspot name="hs_363751_livingroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-85.77997142385482" atv="4.450007192296793" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Living Room, fs_helvetica)" onclick="lookto(-85.77997142385482, get(view.vlookat), get(view.fov));act_change_scene_363751();"/>
    <hotspot name="hs_363755_upstairslandingsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="176.34985775694005" atv="-0.8129653511737864" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Upstairs Landing, fs_helvetica)" onclick="lookto(176.34985775694005, get(view.vlookat), get(view.fov));act_change_scene_363755();"/>
    <hotspot name="hs_363758_kitchensm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-27.416650472342155" atv="2.467797910263464" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Kitchen, fs_helvetica)" onclick="lookto(-27.416650472342155, get(view.vlookat), get(view.fov));act_change_scene_363758();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363758_kitchensm" title="Kitchen" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363758_kitchensm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363758_kitchensm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363758_kitchensm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363758_kitchensm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>    
    <hotspot name="hs_363747_frontlobbysm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="133.62718435526162" atv="2.4835219987532975" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Front Lobby, fs_helvetica)" onclick="lookto(133.62718435526162, get(view.vlookat), get(view.fov));act_change_scene_363747();"/>
    <hotspot name="hs_363751_livingroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-117.42041974996752" atv="6.455164960824204" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Living Room, fs_helvetica)" onclick="lookto(-117.42041974996752, get(view.vlookat), get(view.fov));act_change_scene_363751();"/>
    <hotspot name="hs_363755_upstairslandingsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="149.80310735422637" atv="-3.4488130036384614" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Upstairs Landing, fs_helvetica)" onclick="lookto(149.80310735422637, get(view.vlookat), get(view.fov));act_change_scene_363755();"/>
    <hotspot name="ihs_36504_1" url="%CURRENTXML%/uploads/hs_images/6_1341071577.png" ath="13.778125257810757" atv="14.434741404599235" scale="0.8" zoom="true" alpha="1" onout_alpha="1" width="100" height="100" imagewidth="100" imageheight="100" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Wolfe Stove, fs_helvetica)" onclick="set(plugin[pi_overlay].visible, true);set(autorotate.enabled, false);action(act_show_info_flexible, dt_36504_1, 1, 387);"/>
	</scene>

	<scene name="sc_363751_livingroomsm" title="Living Room" start_hlookat="56.61825290909411" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363751_livingroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="56.61825290909411" vlookat="9.520502428245434" fovtype="MFOV" fov="111" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363751_livingroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363751_livingroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363751_livingroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363755_upstairslandingsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="-69.93659124722546" atv="1.2793173868933327" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Upstairs Landing, fs_helvetica)" onclick="lookto(-69.93659124722546, get(view.vlookat), get(view.fov));act_change_scene_363755();"/>
    <hotspot name="hs_363756_outdoorpatiosm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="50.40476025850895" atv="-2.774349969262493" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Outdoor Patio, fs_helvetica)" onclick="lookto(50.40476025850895, get(view.vlookat), get(view.fov));act_change_scene_363756();"/>
    <hotspot name="hs_363758_kitchensm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="-113.22185525162269" atv="5.55589002646878" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Kitchen, fs_helvetica)" onclick="lookto(-113.22185525162269, get(view.vlookat), get(view.fov));act_change_scene_363758();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363756_outdoorpatiosm" title="Outdoor Patio" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363756_outdoorpatiosm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363756_outdoorpatiosm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363756_outdoorpatiosm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363756_outdoorpatiosm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363751_livingroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="98.8411553019109" atv="4.54114986259703" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Living Room, fs_helvetica)" onclick="lookto(98.8411553019109, get(view.vlookat), get(view.fov));act_change_scene_363751();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363755_upstairslandingsm" title="Upstairs Landing" start_hlookat="-45.81904247690153" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363755_upstairslandingsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="-45.81904247690153" vlookat="9.468045934764623" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363755_upstairslandingsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363755_upstairslandingsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363755_upstairslandingsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363746_gameroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="-50.40172353921167" atv="-7.2393660763780145" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Game Room 1, fs_helvetica)" onclick="lookto(-50.40172353921167, get(view.vlookat), get(view.fov));act_change_scene_363746();"/>
    <hotspot name="hs_363749_bedroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184250.png" ath="87.39686723229374" atv="4.174250671688006" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Bedroom 3, fs_helvetica)" onclick="lookto(87.39686723229374, get(view.vlookat), get(view.fov));act_change_scene_363749();"/>
    <hotspot name="hs_363750_bedroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184244.png" ath="85.51726010098332" atv="-1.8368226863561068" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Bedroom 2, fs_helvetica)" onclick="lookto(85.51726010098332, get(view.vlookat), get(view.fov));act_change_scene_363750();"/>
    <hotspot name="hs_363753_masterbedroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-84.09130992819104" atv="1.68800490067211" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Master Bedroom, fs_helvetica)" onclick="lookto(-84.09130992819104, get(view.vlookat), get(view.fov));act_change_scene_363753();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363753_masterbedroomsm" title="Master Bedroom" start_hlookat="-109.1322833679218" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363753_masterbedroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="-109.1322833679218" vlookat="4.843551352965345" fovtype="MFOV" fov="121" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363753_masterbedroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363753_masterbedroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363753_masterbedroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363752_masterbathroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="164.80471395313816" atv="4.889600051703008" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Master Bathroom, fs_helvetica)" onclick="lookto(164.80471395313816, get(view.vlookat), get(view.fov));act_change_scene_363752();"/>
    <hotspot name="hs_363755_upstairslandingsm" url="%CURRENTXML%/uploads/hs_images/92_1410184250.png" ath="165.0759724934243" atv="-11.35644298076744" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Upstairs Landing, fs_helvetica)" onclick="lookto(165.0759724934243, get(view.vlookat), get(view.fov));act_change_scene_363755();"/>
    <hotspot name="hs_363757_masterclosetsm" url="%CURRENTXML%/uploads/hs_images/92_1410184235.png" ath="166.64782103454462" atv="15.6086989577198" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Master Closet, fs_helvetica)" onclick="lookto(166.64782103454462, get(view.vlookat), get(view.fov));act_change_scene_363757();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363752_masterbathroomsm" title="Master Bathroom" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363752_masterbathroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363752_masterbathroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363752_masterbathroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363752_masterbathroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363757_masterclosetsm" title="Master Closet" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363757_masterclosetsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363757_masterclosetsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363757_masterclosetsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363757_masterclosetsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363750_bedroomsm" title="Bedroom 2" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363750_bedroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363750_bedroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363750_bedroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363750_bedroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363749_bedroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184250.png" ath="-89.0338225326509" atv="4.877083388065939" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Bedroom 3, fs_helvetica)" onclick="lookto(-89.0338225326509, get(view.vlookat), get(view.fov));act_change_scene_363749();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363749_bedroomsm" title="Bedroom 3" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363749_bedroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363749_bedroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363749_bedroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363749_bedroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
    <hotspot name="hs_363755_upstairslandingsm" url="%CURRENTXML%/uploads/hs_images/92_1410184250.png" ath="114.16818297243056" atv="2.389969443627733" scale="0.8" zoom="true" alpha="0.8" onout_alpha="0.8" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Upstairs Landing, fs_helvetica)" onclick="lookto(114.16818297243056, get(view.vlookat), get(view.fov));act_change_scene_363755();"/>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>
	</scene>

	<scene name="sc_363746_gameroomsm" title="Game Room 1" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363746_gameroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363746_gameroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363746_gameroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363746_gameroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>    <hotspot name="hs_363754_gameroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-12.084858420754585" atv="5.7975082271878975" scale="0.8" zoom="true" alpha="1" onout_alpha="1" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Game Room 2, fs_helvetica)" onclick="lookto(-12.084858420754585, get(view.vlookat), get(view.fov));act_change_scene_363754();"/>
	</scene>

	<scene name="sc_363754_gameroomsm" title="Game Room 2" start_hlookat="0" thumburl="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363754_gameroomsm.tiles/thumbnail.jpg" onstart="">
	<view hlookat="0" vlookat="0" fovtype="MFOV" fov="105" fovmin="45" fovmax="135" limitview="auto"/>
	<preview url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363754_gameroomsm.tiles/preview.jpg"/>
	<image>
		<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363754_gameroomsm.tiles/pano_%s.jpg"/>
		<mobile>
			<cube url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/363754_gameroomsm.tiles/mobile_%s.jpg"/>
		</mobile>
	</image>
<hotspot name="nhs_nadir" url="/uploads/nadirs/6_o7ahPdpQ_1572049057.png" ath="0" atv="90" width="550" height="550" scale="1.0" alpha="1.0" zoom="true" onclick="openurl(https://luxurydfwrealestate.com/soldhome/, _blank);"/>    <hotspot name="hs_363746_gameroomsm" url="%CURRENTXML%/uploads/hs_images/92_1410184219.png" ath="-84.5728813077535" atv="5.3180998709321186" scale="0.8" zoom="true" alpha="1" onout_alpha="1" width="60" height="60" imagewidth="60" imageheight="60" onover="tween(alpha,1);tween(scale,1);" onout="tween(alpha,get(hotspot[get(name)].onout_alpha));tween(scale,0.8);" onhover="showtext(Game Room 1, fs_helvetica)" onclick="lookto(-84.5728813077535, get(view.vlookat), get(view.fov));act_change_scene_363746();"/>
	</scene>

        <combobox name="combobox" align="top" x="0" y="50"
            keep="true" design="default"
            alpha="1.0" rowcount="10" onloaded="setup_location_combo();"></combobox>
    <action name="setup_location_combo">
        layer[combobox].removeAll();
		layer[combobox].addNamedItem(cbo_363748, Front Elevation, act_change_scene_363748(););
		layer[combobox].addNamedItem(cbo_363747, Front Lobby, act_change_scene_363747(););
		layer[combobox].addNamedItem(cbo_363758, Kitchen, act_change_scene_363758(););
		layer[combobox].addNamedItem(cbo_363751, Living Room, act_change_scene_363751(););
		layer[combobox].addNamedItem(cbo_363756, Outdoor Patio, act_change_scene_363756(););
		layer[combobox].addNamedItem(cbo_363755, Upstairs Landing, act_change_scene_363755(););
		layer[combobox].addNamedItem(cbo_363753, Master Bedroom, act_change_scene_363753(););
		layer[combobox].addNamedItem(cbo_363752, Master Bathroom, act_change_scene_363752(););
		layer[combobox].addNamedItem(cbo_363757, Master Closet, act_change_scene_363757(););
		layer[combobox].addNamedItem(cbo_363750, Bedroom 2, act_change_scene_363750(););
		layer[combobox].addNamedItem(cbo_363749, Bedroom 3, act_change_scene_363749(););
		layer[combobox].addNamedItem(cbo_363746, Game Room 1, act_change_scene_363746(););
		layer[combobox].addNamedItem(cbo_363754, Game Room 2, act_change_scene_363754(););
    </action>

        <vpix_floor_plan name="fpi_5596" url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/fp_zdmgj3r0_1553814156.png"
              width="256" height="600" cbo_id="fp_cbo_5596"
              description="1st Floor" />
        <vpix_floor_plan name="fpi_5597" url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/fp_5LjRirwW_1553814169.png"
              width="256" height="600" cbo_id="fp_cbo_5597"
              description="2nd Floor" />
        <vpix_floor_plan name="fpi_5598" url="%CURRENTXML%/uploads/panos/southlakehomedfloorplan754104/fp_XIqCWPvd_1553814181.png"
              width="256" height="600" cbo_id="fp_cbo_5598"
              description="3rd Floor" />
        <vpix_scene_spot name="fps_363747" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5596"
            x="172" y="119" width="32" height="32" heading="172"
            onhover="showtext(Front Lobby);" action="act_change_scene_363747();" />
        <vpix_scene_spot name="fps_363748" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5596"
            x="207" y="94" width="32" height="32" heading="201"
            onhover="showtext(Front Elevation);" action="act_change_scene_363748();" />
        <vpix_scene_spot name="fps_363751" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5596"
            x="129" y="209" width="32" height="32" heading="27"
            onhover="showtext(Living Room);" action="act_change_scene_363751();" />
        <vpix_scene_spot name="fps_363756" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5596"
            x="113" y="348" width="32" height="32" heading="117"
            onhover="showtext(Outdoor Patio);" action="act_change_scene_363756();" />
        <vpix_scene_spot name="fps_363758" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5596"
            x="109" y="155" width="32" height="32" heading="159"
            onhover="showtext(Kitchen);" action="act_change_scene_363758();" />
        <vpix_scene_spot name="fps_363749" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="158" y="540" width="32" height="32" heading="-10"
            onhover="showtext(Bedroom 3);" action="act_change_scene_363749();" />
        <vpix_scene_spot name="fps_363750" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="89" y="514" width="32" height="32" heading="155"
            onhover="showtext(Bedroom 2);" action="act_change_scene_363750();" />
        <vpix_scene_spot name="fps_363752" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="97" y="152" width="32" height="32" heading="0"
            onhover="showtext(Master Bathroom);" action="act_change_scene_363752();" />
        <vpix_scene_spot name="fps_363753" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="100" y="100" width="32" height="32" heading="-94"
            onhover="showtext(Master Bedroom);" action="act_change_scene_363753();" />
        <vpix_scene_spot name="fps_363755" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="184" y="220" width="32" height="32" heading="117"
            onhover="showtext(Upstairs Landing);" action="act_change_scene_363755();" />
        <vpix_scene_spot name="fps_363757" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5597"
            x="84" y="236" width="32" height="32" heading="18"
            onhover="showtext(Master Closet);" action="act_change_scene_363757();" />
        <vpix_scene_spot name="fps_363746" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5598"
            x="113" y="285" width="32" height="32" heading="-75"
            onhover="showtext(Game Room 1);" action="act_change_scene_363746();" />
        <vpix_scene_spot name="fps_363754" url="%CURRENTXML%/assets/dot-blue.png" floor_plan="fpi_5598"
            x="54" y="229" width="32" height="32" heading="38"
            onhover="showtext(Game Room 2);" action="act_change_scene_363754();" />
        <plugin name="pi_hide_floor_plan" url="%CURRENTXML%/assets/close-map.png"
                keep="true" visible="false" enabled="true" handcursor="true"
                capture="true" children="true" zorder="20" alpha="1.0" blendmode="normal"
                smoothing="true" align="left" edge="" x="0" y="0" width="24" height="24"
                onhover="showtext(Hide floor plan);" onclick="act_floor_plan_hide();"
                />
	<include url="%CURRENTXML%/vpix_plugin.php?xml=vpix_floor_plans.xml" />

        <plugin name="pi_show_floor_plan" url="%CURRENTXML%/assets/show_plan.png"
                keep="true" visible="true" enabled="true" handcursor="true"
                capture="true" children="false" zorder="0" alpha="1.0" blendmode="normal"
                smoothing="true" align="left" edge="0" x="20" y="-180"
                width="32" height="144" scale="1" onhover="showtext(Show floor plan);"
                onclick="act_floor_plan_show();"
                />
		<data name="dt_36504_1" img_url="https://www.vpix.net/uploads/panos/southlakehomedfloorplan754104/infobox/4r50qpfk_1587066319.jpg" width="387" height="480">
  [div]
    [p align="center"][b style="font-size: 14px;"]Wolfe Stove[/b][/p]
    [p]Home features a brand new WOLF commercial stove, ideal for any aspiring Chef in your family. Recently installed and comes with a 10-year warranty. 
[/p]  [br style="clear:both;" /]
[/div]
</data>
	<include url="%CURRENTXML%/vpix_plugin.php?xml=vpix_infoboxes.xml" />

    <plugin name="gyro" url="%CURRENTXML%/plugins/gyro2.js" keep="true" devices="html5"
            enabled="true" camroll="true"
    />
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
    <plugin name="pi_full_screen" url="%CURRENTXML%/assets/full-screen.png" align="lefttop" 
            x="20" y="0" width="75" height="25" enabled="true" keep="true" visible="true" 
            onhover="showtext(Full screen);" onclick="switch(fullscreen); " 
            />

    <plugin name="pi_hide_tools" url="%CURRENTXML%/assets/hide-tools.png" align="lefttop" 
            x="100" y="0" width="75" height="25" enabled="true" keep="true" visible="true" 
            onhover="showtext(Hide controls);" onclick="action(act_show_hide_tools);" 
            />
    <plugin name="pi_show_tools" url="%CURRENTXML%/assets/show-tools.png" align="lefttop" 
            x="100" y="0" width="75" height="25" enabled="true" keep="true" visible="false" 
            onhover="showtext(Show controls);" onclick="action(act_show_hide_tools);" 
            />
    <plugin name="pi_embed_share" url="%CURRENTXML%/assets/Embed_Share.png"
            align="lefttop" x="340" y="0" width="106" height="25" enabled="true" keep="true" visible="true"
            onhover="showtext(Code for Embedding/Sharing);" onclick="js(show_embed();)"
            />
    <plugin name="pi_info_screen_1" url="/assets/images/start_tour_info_screen.png" devices="mouse"
            align="center" edge="center" textalign="center" keep="true" visible="false"
            x="0" y="0" width="360" height="262"
            vpix_show_on_start="false" onloaded="if(vpix_show_on_start, set(visible, true););"
            onclick="set(visible, false);"
            />
    <plugin name="pi_info_screen_2" url="/assets/images/start_tour_info_screen.png" devices="touch"
            align="center" edge="center" textalign="center" keep="true" visible="false"
            x="0" y="0" width="360" height="262"
            vpix_show_on_start="false" onloaded="if(vpix_show_on_start, set(visible, true););"
            onclick="set(visible, false);js(VpixTour.playerClicked(););"
            />
    <plugin name="pi_getinfo" url="%CURRENTXML%/assets/get-info.png"
            align="leftbottom" x="20" y="20" width="40" height="40"
            keep="true" blendmode="normal" enabled="true" alpha="0.75"
            onhover="showtext(Navigation info);"
            onclick="if(device.mouse, switch(plugin[pi_info_screen_1].visible);, switch(plugin[pi_info_screen_2].visible););"
            />
    <textstyle name="fs_helvetica" font="Helvetica" fontsize="22" bold="true" italic="false"
             background="true" backgroundcolor="0x4a86e8" padding="5"  roundedge="4"  textcolor="0xFFFFFF"
            yoffset="25" edge="top" blendmode="normal" border="false" alpha="1"
            effect="glow(0xFFFFFF, 0.45, 1, 50);dropshadow(2, 45, 0x010101, 2, 55);"
            />


	<action name="vpix_eh_onloadcomplete">
		ifnot (vpix_gs_onload_done === true,
			set(vpix_gs_onload_done, true);
		);
	</action>


	<action name="act_init_last">
	</action>


</krpano>