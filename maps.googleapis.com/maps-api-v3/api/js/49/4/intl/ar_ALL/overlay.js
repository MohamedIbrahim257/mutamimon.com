google.maps.__gjsload__('overlay', function(_){var Rt=function(a){this.h=a},Ala=function(){},St=function(a){a.Zo=a.Zo||new Ala;return a.Zo},Bla=function(a){this.Oa=new _.ei(function(){var b=a.Zo;if(a.getPanes()){if(a.getProjection()){if(!b.Zn&&a.onAdd)a.onAdd();b.Zn=!0;a.draw()}}else{if(b.Zn)if(a.onRemove)a.onRemove();else a.remove();b.Zn=!1}},0)},Cla=function(a,b){function c(){return _.fi(e.Oa)}var d=St(a),e=d.Hm;e||(e=d.Hm=new Bla(a));_.pb(d.ab||[],_.F.removeListener);var f=d.Ya=d.Ya||new _.Vr,g=b.__gm;f.bindTo("zoom",g);f.bindTo("offset",g);
f.bindTo("center",g,"projectionCenterQ");f.bindTo("projection",b);f.bindTo("projectionTopLeft",g);f=d.Ps=d.Ps||new Rt(f);f.bindTo("zoom",g);f.bindTo("offset",g);f.bindTo("projection",b);f.bindTo("projectionTopLeft",g);a.bindTo("projection",f,"outProjection");a.bindTo("panes",g);d.ab=[_.F.addListener(a,"panes_changed",c),_.F.addListener(g,"zoom_changed",c),_.F.addListener(g,"offset_changed",c),_.F.addListener(b,"projection_changed",c),_.F.addListener(g,"projectioncenterq_changed",c)];c();b instanceof
_.pf&&(_.rg(b,"Ox"),_.fg(b,148440))},Gla=function(a){if(a){var b=a.getMap();if(Dla(a)!==b&&b&&b instanceof _.pf){var c=b.__gm;c.overlayLayer?a.__gmop=new Ela(b,a,c.overlayLayer):c.h.then(function(d){d=d.Qa;var e=new Tt(b,d);d.ub(e);c.overlayLayer=e;Fla(a);Gla(a)})}}},Fla=function(a){if(a){var b=a.__gmop;b&&(a.__gmop=null,b.h.unbindAll(),b.h.set("panes",null),b.h.set("projection",null),b.l.ug(b),b.j&&(b.j=!1,b.h.onRemove?b.h.onRemove():b.h.remove()))}},Dla=function(a){return(a=a.__gmop)?a.map:null},
Ela=function(a,b,c){this.map=a;this.h=b;this.l=c;this.j=!1;_.rg(this.map,"Ox");_.fg(this.map,148440);c.Sf(this)},Hla=function(a,b){a.h.get("projection")!=b&&(a.h.bindTo("panes",a.map.__gm),a.h.set("projection",b))},Tt=function(a,b){this.m=a;this.l=b;this.h=null;this.j=[]};_.C(Rt,_.G);
Rt.prototype.changed=function(a){"outProjection"!=a&&(a=!!(this.get("offset")&&this.get("projectionTopLeft")&&this.get("projection")&&_.le(this.get("zoom"))),a==!this.get("outProjection")&&this.set("outProjection",a?this.h:null))};var Ut={};_.C(Bla,_.G);Ut.Sf=function(a){if(a){var b=a.getMap();(St(a).ws||null)!==b&&(b&&Cla(a,b),St(a).ws=b)}};Ut.ug=function(a){var b=St(a),c=b.Ya;c&&c.unbindAll();(c=b.Ps)&&c.unbindAll();a.unbindAll();a.set("panes",null);a.set("projection",null);b.ab&&_.pb(b.ab,_.F.removeListener);b.ab=null;b.Hm&&(b.Hm.Oa.Sd(),b.Hm=null);delete St(a).ws};var Vt={};Ela.prototype.draw=function(){this.j||(this.j=!0,this.h.onAdd&&this.h.onAdd());this.h.draw&&this.h.draw()};Tt.prototype.dispose=function(){};Tt.prototype.Lc=function(a,b,c,d,e,f,g,h){var k=this.h=this.h||new _.Hp(this.m,this.l,function(){});k.Lc(a,b,c,d,e,f,g,h);a=_.z(this.j);for(b=a.next();!b.done;b=a.next())b=b.value,Hla(b,k),b.draw()};Tt.prototype.Sf=function(a){this.j.push(a);this.h&&Hla(a,this.h);this.l.refresh()};Tt.prototype.ug=function(a){_.wb(this.j,a)};Vt.Sf=Gla;Vt.ug=Fla;_.af("overlay",{oq:function(a){if(a){(0,Ut.ug)(a);(0,Vt.ug)(a);var b=a.getMap();b&&(b instanceof _.pf?(0,Vt.Sf)(a):(0,Ut.Sf)(a))}},preventMapHitsFrom:function(a){_.kq(a,{onClick:function(b){return _.Qp(b.event)},Ad:function(b){return _.Np(b)},ji:function(b){return _.Op(b)},je:function(b){return _.Op(b)},Ld:function(b){return _.Pp(b)}}).gj(!0)},preventMapHitsAndGesturesFrom:function(a){a.addEventListener("click",_.ff);a.addEventListener("contextmenu",_.ff);a.addEventListener("dblclick",_.ff);a.addEventListener("mousedown",
_.ff);a.addEventListener("mousemove",_.ff);a.addEventListener("MSPointerDown",_.ff);a.addEventListener("pointerdown",_.ff);a.addEventListener("touchstart",_.ff);a.addEventListener("wheel",_.ff)}});});
