(function(b){b.runtimes.BrowserPlus=b.addRuntime("browserplus",{getFeatures:function(){return{dragdrop:true,jpgresize:true,pngresize:true,chunks:true,progress:true,multipart:true}},init:function(l,j){var n=window.BrowserPlus,k={},o=l.settings,p=o.resize;function m(h){var c,d,f=[],e,g;for(d=0;d<h.length;d++){e=h[d];g=b.guid();k[g]=e;f.push(new b.File(g,e.name,e.size))}if(d){l.trigger("FilesAdded",f)}}function a(){l.bind("PostInit",function(){var c,e=o.drop_element,h=l.id+"_droptarget",f=document.getElementById(e),d;function g(s,t){n.DragAndDrop.AddDropTarget({id:s},function(q){n.DragAndDrop.AttachCallbacks({id:s,hover:function(r){if(!r&&t){t()}},drop:function(r){if(t){t()}m(r)}},function(){})})}function i(){document.getElementById(h).style.top="-1000px"}if(f){if(document.attachEvent&&(/MSIE/gi).test(navigator.userAgent)){c=document.createElement("div");c.setAttribute("id",h);b.extend(c.style,{position:"absolute",top:"-1000px",background:"red",filter:"alpha(opacity=0)",opacity:0});document.body.appendChild(c);b.addEvent(f,"dragenter",function(u){var v,t;v=document.getElementById(e);t=b.getPos(v);b.extend(document.getElementById(h).style,{top:t.y+"px",left:t.x+"px",width:v.offsetWidth+"px",height:v.offsetHeight+"px"})});g(h,i)}else{g(e)}}b.addEvent(document.getElementById(o.browse_button),"click",function(w){var y=[],A,B,x=o.filters,z;w.preventDefault();for(A=0;A<x.length;A++){z=x[A].extensions.split(",");for(B=0;B<z.length;B++){y.push(b.mimeTypes[z[B]])}}n.FileBrowse.OpenBrowseDialog({mimeTypes:y},function(q){if(q.success){m(q.value)}})});f=c=null});l.bind("UploadFile",function(h,t){var i=k[t.id],c={},s=h.settings.chunk_size,g,f=[];function d(v,q){var r;if(t.status==b.FAILED){return}c.name=t.target_name||t.name;if(s){c.chunk=""+v;c.chunks=""+q}r=f.shift();n.Uploader.upload({url:h.settings.url,files:{file:r},cookies:document.cookies,postvars:b.extend(c,h.settings.multipart_params),progressCallback:function(u){var y,z=0;g[v]=parseInt(u.filePercent*r.size/100,10);for(y=0;y<g.length;y++){z+=g[y]}t.loaded=z;h.trigger("UploadProgress",t)}},function(y){var z,u;if(y.success){z=y.value.statusCode;if(s){h.trigger("ChunkUploaded",t,{chunk:v,chunks:q,response:y.value.body,status:z})}if(f.length>0){d(++v,q)}else{t.status=b.DONE;h.trigger("FileUploaded",t,{response:y.value.body,status:z});if(z>=400){h.trigger("Error",{code:b.HTTP_ERROR,message:b.translate("HTTP Error."),file:t,status:z})}}}else{h.trigger("Error",{code:b.GENERIC_ERROR,message:b.translate("Generic Error."),file:t,details:y.error})}})}function e(q){t.size=q.size;if(s){n.FileAccess.chunk({file:q,chunkSize:s},function(x){if(x.success){var r=x.value,z=r.length;g=Array(z);for(var y=0;y<z;y++){g[y]=0;f.push(r[y])}d(0,z)}})}else{g=Array(1);f.push(q);d(0,1)}}if(p&&/\.(png|jpg|jpeg)$/i.test(t.name)){BrowserPlus.ImageAlter.transform({file:i,quality:p.quality||90,actions:[{scale:{maxwidth:p.width,maxheight:p.height}}]},function(q){if(q.success){e(q.value.file)}})}else{e(i)}});j({success:true})}if(n){n.init(function(c){var d=[{service:"Uploader",version:"3"},{service:"DragAndDrop",version:"1"},{service:"FileBrowse",version:"1"},{service:"FileAccess",version:"2"}];if(p){d.push({service:"ImageAlter",version:"4"})}if(c.success){n.require({services:d},function(e){if(e.success){a()}else{j()}})}else{j()}})}else{j()}}})})(plupload);