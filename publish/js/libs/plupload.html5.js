(function(q,o,p,t){var r;if(q.Uint8Array&&q.ArrayBuffer&&!XMLHttpRequest.prototype.sendAsBinary){XMLHttpRequest.prototype.sendAsBinary=function(b){var a=new Uint8Array(b.length);for(var c=0;c<b.length;c++){a[c]=(b.charCodeAt(c)&255)}this.send(a.buffer)}}function m(c,b){var a;if("FileReader" in q){a=new FileReader();a.readAsDataURL(c);a.onload=function(){b(a.result)}}else{return b(c.getAsDataURL())}}function n(c,b){var a;if("FileReader" in q){a=new FileReader();a.readAsBinaryString(c);a.onload=function(){b(a.result)}}else{return b(c.getAsBinary())}}function u(e,g,d,b){var h,f,a,c;m(e,function(j){h=o.createElement("canvas");h.style.display="none";o.body.appendChild(h);f=h.getContext("2d");a=new Image();a.onerror=a.onabort=function(){b({success:false})};a.onload=function(){var D,C,l,B,E;if(!g.width){g.width=a.width}if(!g.height){g.height=a.height}c=Math.min(g.width/a.width,g.height/a.height);if(c<1||(c===1&&d==="image/jpeg")){D=Math.round(a.width*c);C=Math.round(a.height*c);h.width=D;h.height=C;f.drawImage(a,0,0,D,C);if(d==="image/jpeg"){B=new s(atob(j.substring(j.indexOf("base64,")+7)));if(B.headers&&B.headers.length){E=new w();if(E.init(B.get("exif")[0])){E.setExif("PixelXDimension",D);E.setExif("PixelYDimension",C);B.set("exif",E.getBinary())}}if(g.quality){try{j=h.toDataURL(d,g.quality/100)}catch(k){j=h.toDataURL(d)}}}else{j=h.toDataURL(d)}j=j.substring(j.indexOf("base64,")+7);j=atob(j);if(B.headers&&B.headers.length){j=B.restore(j);B.purge()}h.parentNode.removeChild(h);b({success:true,data:j})}else{b({success:false})}};a.src=j})}p.runtimes.Html5=p.addRuntime("html5",{getFeatures:function(){var b,f,c,e,a,d=q;f=c=e=a=false;if(d.XMLHttpRequest){b=new XMLHttpRequest();c=!!b.upload;f=!!(b.sendAsBinary||b.upload)}if(f){e=!!(File&&(File.prototype.getAsDataURL||d.FileReader)&&b.sendAsBinary);a=!!(File&&File.prototype.slice)}r=navigator.userAgent.indexOf("Safari")>0&&navigator.vendor.indexOf("Apple")!==-1;return{html5:f,dragdrop:d.mozInnerScreenX!==t||a||r,jpgresize:e,pngresize:e,multipart:e||!!d.FileReader||!!d.FormData,progress:c,chunks:a||e,canOpenDialog:navigator.userAgent.indexOf("WebKit")!==-1}},init:function(c,b){var a={},e;function d(g){var j,k,h=[],f,l={};for(k=0;k<g.length;k++){j=g[k];if(l[j.name]){continue}l[j.name]=true;f=p.guid();a[f]=j;h.push(new p.File(f,j.fileName,j.fileSize||j.size))}if(h.length){c.trigger("FilesAdded",h)}}e=this.getFeatures();if(!e.html5){b({success:false});return}c.bind("Init",function(H){var J,L,j=[],I,h,M=H.settings.filters,K,k,g=o.body,f;J=o.createElement("div");J.id=H.id+"_html5_container";p.extend(J.style,{position:"absolute",background:c.settings.shim_bgcolor||"transparent",width:"100px",height:"100px",overflow:"hidden",zIndex:99999,opacity:c.settings.shim_bgcolor?"":0});J.className="plupload html5";if(c.settings.container){g=o.getElementById(c.settings.container);if(p.getStyle(g,"position")==="static"){g.style.position="relative"}}g.appendChild(J);no_type_restriction:for(I=0;I<M.length;I++){K=M[I].extensions.split(/,/);for(h=0;h<K.length;h++){if(K[h]==="*"){j=[];break no_type_restriction}k=p.mimeTypes[K[h]];if(k){j.push(k)}}}J.innerHTML='<input id="'+c.id+'_html5" style="width:100%;height:100%;font-size:99px" type="file" accept="'+j.join(",")+'" '+(c.settings.multi_selection?'multiple="multiple"':"")+" />";f=o.getElementById(c.id+"_html5");f.onchange=function(){d(this.files);this.value=""};L=o.getElementById(H.settings.browse_button);if(L){var y=H.settings.browse_button_hover,l=H.settings.browse_button_active,G=H.features.canOpenDialog?L:J;if(y){p.addEvent(G,"mouseover",function(){p.addClass(L,y)},H.id);p.addEvent(G,"mouseout",function(){p.removeClass(L,y)},H.id)}if(l){p.addEvent(G,"mousedown",function(){p.addClass(L,l)},H.id);p.addEvent(o.body,"mouseup",function(){p.removeClass(L,l)},H.id)}if(H.features.canOpenDialog){p.addEvent(L,"click",function(x){o.getElementById(H.id+"_html5").click();x.preventDefault()},H.id)}}});c.bind("PostInit",function(){var f=o.getElementById(c.settings.drop_element);
if(f){if(r){p.addEvent(f,"dragenter",function(g){var h,k,j;h=o.getElementById(c.id+"_drop");if(!h){h=o.createElement("input");h.setAttribute("type","file");h.setAttribute("id",c.id+"_drop");h.setAttribute("multiple","multiple");p.addEvent(h,"change",function(){d(this.files);p.removeEvent(h,"change",c.id);h.parentNode.removeChild(h)},c.id);f.appendChild(h)}k=p.getPos(f,o.getElementById(c.settings.container));j=p.getSize(f);if(p.getStyle(f,"position")==="static"){p.extend(f.style,{position:"relative"})}p.extend(h.style,{position:"absolute",display:"block",top:0,left:0,width:j.w+"px",height:j.h+"px",opacity:0})},c.id);return}p.addEvent(f,"dragover",function(g){g.preventDefault()},c.id);p.addEvent(f,"drop",function(g){var h=g.dataTransfer;if(h&&h.files){d(h.files)}g.preventDefault()},c.id)}});c.bind("Refresh",function(l){var k,h,g,f,j;k=o.getElementById(c.settings.browse_button);if(k){h=p.getPos(k,o.getElementById(l.settings.container));g=p.getSize(k);f=o.getElementById(c.id+"_html5_container");p.extend(f.style,{top:h.y+"px",left:h.x+"px",width:g.w+"px",height:g.h+"px"});if(c.features.canOpenDialog){j=parseInt(k.parentNode.style.zIndex,10);if(isNaN(j)){j=0}p.extend(k.style,{zIndex:j});if(p.getStyle(k,"position")==="static"){p.extend(k.style,{position:"relative"})}p.extend(f.style,{zIndex:j-1})}}});c.bind("UploadFile",function(l,j){var h=l.settings,f,k;function g(C){var B=0,D=0;function E(){var X=C,Q,A,U,T,S=0,x="----pluploadboundary"+p.guid(),Y,W,aa,Z="--",R="\r\n",V="",y,z=l.settings.url;if(j.status==p.DONE||j.status==p.FAILED||l.state==p.STOPPED){return}T={name:j.target_name||j.name};if(h.chunk_size&&e.chunks){Y=h.chunk_size;U=Math.ceil(j.size/Y);W=Math.min(Y,j.size-(B*Y));if(typeof(C)=="string"){X=C.substring(B*Y,B*Y+W)}else{X=C.slice(B*Y,W)}T.chunk=B;T.chunks=U}else{W=j.size}Q=new XMLHttpRequest();A=Q.upload;if(A){A.onprogress=function(F){j.loaded=Math.min(j.size,D+F.loaded-S);l.trigger("UploadProgress",j)}}if(!l.settings.multipart||!e.multipart){z=p.buildUrl(l.settings.url,T)}else{T.name=j.target_name||j.name}Q.open("post",z,true);Q.onreadystatechange=function(){var H,F;if(Q.readyState==4){try{H=Q.status}catch(G){H=0}if(H>=400){l.trigger("Error",{code:p.HTTP_ERROR,message:p.translate("HTTP Error."),file:j,status:H})}else{if(U){F={chunk:B,chunks:U,response:Q.responseText,status:H};l.trigger("ChunkUploaded",j,F);D+=W;if(F.cancelled){j.status=p.FAILED;return}j.loaded=Math.min(j.size,(B+1)*Y)}else{j.loaded=j.size}l.trigger("UploadProgress",j);if(!U||++B>=U){j.status=p.DONE;l.trigger("FileUploaded",j,{response:Q.responseText,status:H});f=C=a[j.id]=null}else{E()}}Q=X=aa=V=null}};p.each(l.settings.headers,function(F,G){Q.setRequestHeader(G,F)});if(l.settings.multipart&&e.multipart){if(!Q.sendAsBinary){aa=new FormData();p.each(p.extend(T,l.settings.multipart_params),function(F,G){aa.append(G,F)});aa.append(l.settings.file_data_name,X);Q.send(aa);return}Q.setRequestHeader("Content-Type","multipart/form-data; boundary="+x);p.each(p.extend(T,l.settings.multipart_params),function(F,G){V+=Z+x+R+'Content-Disposition: form-data; name="'+G+'"'+R+R;V+=unescape(encodeURIComponent(F))+R});y=p.mimeTypes[j.name.replace(/^.+\.([^.]+)/,"$1").toLowerCase()]||"application/octet-stream";V+=Z+x+R+'Content-Disposition: form-data; name="'+l.settings.file_data_name+'"; filename="'+unescape(encodeURIComponent(j.name))+'"'+R+"Content-Type: "+y+R+R+X+R+Z+x+Z+R;S=V.length-X.length;X=V}else{Q.setRequestHeader("Content-Type","application/octet-stream")}if(Q.sendAsBinary){Q.sendAsBinary(X)}else{Q.send(X)}}E()}f=a[j.id];k=l.settings.resize;if(e.jpgresize){if(k&&/\.(png|jpg|jpeg)$/i.test(j.name)){u(f,k,/\.png$/i.test(j.name)?"image/png":"image/jpeg",function(y){if(y.success){j.size=y.data.length;g(y.data)}else{n(f,g)}})}else{n(f,g)}}else{g(f)}});c.bind("Destroy",function(k){var h,g,j=o.body,f={inputContainer:k.id+"_html5_container",inputFile:k.id+"_html5",browseButton:k.settings.browse_button,dropElm:k.settings.drop_element};for(h in f){g=o.getElementById(f[h]);if(g){p.removeAllEvents(g,k.id)
}}p.removeAllEvents(o.body,k.id);if(k.settings.container){j=o.getElementById(k.settings.container)}j.removeChild(o.getElementById(f.inputContainer))});b({success:true})}});function v(){var c=false,e;function b(j,g){var k=c?0:-8*(g-1),f=0,h;for(h=0;h<g;h++){f|=(e.charCodeAt(j+h)<<Math.abs(k+h*8))}return f}function a(f,h,g){var g=arguments.length===3?g:e.length-h-1;e=e.substr(0,h)+f+e.substr(g+h)}function d(k,j,g){var f="",l=c?0:-8*(g-1),h;for(h=0;h<g;h++){f+=String.fromCharCode((j>>Math.abs(l+h*8))&255)}a(f,k,g)}return{II:function(f){if(f===t){return c}else{c=f}},init:function(f){c=false;e=f},SEGMENT:function(h,f,g){switch(arguments.length){case 1:return e.substr(h,e.length-h-1);case 2:return e.substr(h,f);case 3:a(g,h,f);break;default:return e}},BYTE:function(f){return b(f,1)},SHORT:function(f){return b(f,2)},LONG:function(g,f){if(f===t){return b(g,4)}else{d(g,f,4)}},SLONG:function(g){var f=b(g,4);return(f>2147483647?f-4294967296:f)},STRING:function(h,g){var f="";for(g+=h;h<g;h++){f+=String.fromCharCode(b(h,1))}return f}}}function s(d){var b={65505:{app:"EXIF",name:"APP1",signature:"Exif\0"},65506:{app:"ICC",name:"APP2",signature:"ICC_PROFILE\0"},65517:{app:"IPTC",name:"APP13",signature:"Photoshop 3.0\0"}},c=[],e,a,g=t,f=0,h;e=new v();e.init(d);if(e.SHORT(0)!==65496){return}a=2;h=Math.min(1048576,d.length);while(a<=h){g=e.SHORT(a);if(g>=65488&&g<=65495){a+=2;continue}if(g===65498||g===65497){break}f=e.SHORT(a+2)+2;if(b[g]&&e.STRING(a+4,b[g].signature.length)===b[g].signature){c.push({hex:g,app:b[g].app.toUpperCase(),name:b[g].name.toUpperCase(),start:a,length:f,segment:e.SEGMENT(a,f)})}a+=f}e.init(null);return{headers:c,restore:function(j){e.init(j);if(e.SHORT(0)!==65496){return false}a=e.SHORT(2)==65504?4+e.SHORT(4):2;for(var k=0,l=c.length;k<l;k++){e.SEGMENT(a,0,c[k].segment);a+=c[k].length}return e.SEGMENT()},get:function(k){var j=[];for(var l=0,y=c.length;l<y;l++){if(c[l].app===k.toUpperCase()){j.push(c[l].segment)}}return j},set:function(j,k){var A=[];if(typeof(k)==="string"){A.push(k)}else{A=k}for(var l=ii=0,z=c.length;l<z;l++){if(c[l].app===j.toUpperCase()){c[l].segment=A[ii];c[l].length=A[ii].length;ii++}if(ii>=A.length){break}}},purge:function(){c=[];e.init(null)}}}function w(){var e,a,g={},b;e=new v();a={tiff:{274:"Orientation",34665:"ExifIFDPointer",34853:"GPSInfoIFDPointer"},exif:{36864:"ExifVersion",40961:"ColorSpace",40962:"PixelXDimension",40963:"PixelYDimension",36867:"DateTimeOriginal",33434:"ExposureTime",33437:"FNumber",34855:"ISOSpeedRatings",37377:"ShutterSpeedValue",37378:"ApertureValue",37383:"MeteringMode",37384:"LightSource",37385:"Flash",41986:"ExposureMode",41987:"WhiteBalance",41990:"SceneCaptureType",41988:"DigitalZoomRatio",41992:"Contrast",41993:"Saturation",41994:"Sharpness"},gps:{0:"GPSVersionID",1:"GPSLatitudeRef",2:"GPSLatitude",3:"GPSLongitudeRef",4:"GPSLongitude"}};b={ColorSpace:{1:"sRGB",0:"Uncalibrated"},MeteringMode:{0:"Unknown",1:"Average",2:"CenterWeightedAverage",3:"Spot",4:"MultiSpot",5:"Pattern",6:"Partial",255:"Other"},LightSource:{1:"Daylight",2:"Fliorescent",3:"Tungsten",4:"Flash",9:"Fine weather",10:"Cloudy weather",11:"Shade",12:"Daylight fluorescent (D 5700 - 7100K)",13:"Day white fluorescent (N 4600 -5400K)",14:"Cool white fluorescent (W 3900 - 4500K)",15:"White fluorescent (WW 3200 - 3700K)",17:"Standard light A",18:"Standard light B",19:"Standard light C",20:"D55",21:"D65",22:"D75",23:"D50",24:"ISO studio tungsten",255:"Other"},Flash:{0:"Flash did not fire.",1:"Flash fired.",5:"Strobe return light not detected.",7:"Strobe return light detected.",9:"Flash fired, compulsory flash mode",13:"Flash fired, compulsory flash mode, return light not detected",15:"Flash fired, compulsory flash mode, return light detected",16:"Flash did not fire, compulsory flash mode",24:"Flash did not fire, auto mode",25:"Flash fired, auto mode",29:"Flash fired, auto mode, return light not detected",31:"Flash fired, auto mode, return light detected",32:"No flash function",65:"Flash fired, red-eye reduction mode",69:"Flash fired, red-eye reduction mode, return light not detected",71:"Flash fired, red-eye reduction mode, return light detected",73:"Flash fired, compulsory flash mode, red-eye reduction mode",77:"Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",79:"Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",89:"Flash fired, auto mode, red-eye reduction mode",93:"Flash fired, auto mode, return light not detected, red-eye reduction mode",95:"Flash fired, auto mode, return light detected, red-eye reduction mode"},ExposureMode:{0:"Auto exposure",1:"Manual exposure",2:"Auto bracket"},WhiteBalance:{0:"Auto white balance",1:"Manual white balance"},SceneCaptureType:{0:"Standard",1:"Landscape",2:"Portrait",3:"Night scene"},Contrast:{0:"Normal",1:"Soft",2:"Hard"},Saturation:{0:"Normal",1:"Low saturation",2:"High saturation"},Sharpness:{0:"Normal",1:"Soft",2:"Hard"},GPSLatitudeRef:{N:"North latitude",S:"South latitude"},GPSLongitudeRef:{E:"East longitude",W:"West longitude"}};
function f(N,k){var K=e.SHORT(N),H,O,M,l,G,L,J,j,h=[],I={};for(H=0;H<K;H++){J=L=N+12*H+2;M=k[e.SHORT(J)];if(M===t){continue}l=e.SHORT(J+=2);G=e.LONG(J+=2);J+=4;h=[];switch(l){case 1:case 7:if(G>4){J=e.LONG(J)+g.tiffHeader}for(O=0;O<G;O++){h[O]=e.BYTE(J+O)}break;case 2:if(G>4){J=e.LONG(J)+g.tiffHeader}I[M]=e.STRING(J,G-1);continue;case 3:if(G>2){J=e.LONG(J)+g.tiffHeader}for(O=0;O<G;O++){h[O]=e.SHORT(J+O*2)}break;case 4:if(G>1){J=e.LONG(J)+g.tiffHeader}for(O=0;O<G;O++){h[O]=e.LONG(J+O*4)}break;case 5:J=e.LONG(J)+g.tiffHeader;for(O=0;O<G;O++){h[O]=e.LONG(J+O*4)/e.LONG(J+O*4+4)}break;case 9:J=e.LONG(J)+g.tiffHeader;for(O=0;O<G;O++){h[O]=e.SLONG(J+O*4)}break;case 10:J=e.LONG(J)+g.tiffHeader;for(O=0;O<G;O++){h[O]=e.SLONG(J+O*4)/e.SLONG(J+O*4+4)}break;default:continue}j=(G==1?h[0]:h);if(b.hasOwnProperty(M)&&typeof j!="object"){I[M]=b[M][j]}else{I[M]=j}}return I}function c(){var h=t,j=g.tiffHeader;e.II(e.SHORT(j)==18761);if(e.SHORT(j+=2)!==42){return false}g.IFD0=g.tiffHeader+e.LONG(j+=2);h=f(g.IFD0,a.tiff);g.exifIFD=("ExifIFDPointer" in h?g.tiffHeader+h.ExifIFDPointer:t);g.gpsIFD=("GPSInfoIFDPointer" in h?g.tiffHeader+h.GPSInfoIFDPointer:t);return true}function d(l,C,E){var j,h,k,D=0;if(typeof(C)==="string"){var B=a[l.toLowerCase()];for(hex in B){if(B[hex]===C){C=hex;break}}}j=g[l.toLowerCase()+"IFD"];h=e.SHORT(j);for(i=0;i<h;i++){k=j+12*i+2;if(e.SHORT(k)==C){D=k+8;break}}if(!D){return false}e.LONG(D,E);return true}return{init:function(h){g={tiffHeader:10};if(h===t||!h.length){return false}e.init(h);if(e.SHORT(0)===65505&&e.STRING(4,5).toUpperCase()==="EXIF\0"){return c()}return false},EXIF:function(){var h;h=f(g.exifIFD,a.exif);h.ExifVersion=String.fromCharCode(h.ExifVersion[0],h.ExifVersion[1],h.ExifVersion[2],h.ExifVersion[3]);return h},GPS:function(){var h;h=f(g.gpsIFD,a.gps);h.GPSVersionID=h.GPSVersionID.join(".");return h},setExif:function(j,h){if(j!=="PixelXDimension"&&j!=="PixelYDimension"){return false}return d("exif",j,h)},getBinary:function(){return e.SEGMENT()}}}})(window,document,plupload);