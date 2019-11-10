function SGPBMediaButton(){}
SGPBMediaButton.prototype.init=function()
{this.openMediaButtonPopup();this.openAskReviewBannerPopup();};SGPBMediaButton.prototype.openMediaButtonPopup=function()
{var that=this;var select2Init=1;jQuery('.sgpb-insert-media-button-js, .sgpb-insert-js-variable').bind('click',function(e){e.preventDefault();var hiddenDivId=jQuery(this).attr('data-id');var popupConfigObj=new PopupConfig();popupConfigObj.magicCall('setContentPadding',14);popupConfigObj.magicCall('setContentBorderRadius',4);popupConfigObj.magicCall('setContentBorderRadiusType','px');popupConfigObj.magicCall('setContentBorderWidth',5);popupConfigObj.magicCall('setContentBorderColor','#506274');popupConfigObj.magicCall('setShadowSpread',1);popupConfigObj.magicCall('setContentShadowBlur',4);popupConfigObj.magicCall('setContentShadowColor','#cccccc');popupConfigObj.magicCall('setMinWidth',400);popupConfigObj.magicCall('setSrcElement',hiddenDivId);popupConfigObj.magicCall('setOverlayColor','black');popupConfigObj.magicCall('setOverlayOpacity',40);var config=popupConfigObj.combineConfigObj();var popup=new SGPopup(config);popup.open();jQuery(window).bind('sgpbDidOpen',function(){jQuery('.sgpb-insert-popup').addClass('js-sg-select2');if(mediaButtonParams.currentPostType!=mediaButtonParams.popupBuilderPostType){jQuery('.sgpb-insert-popup-event').addClass('js-sg-select2');if(select2Init==1){that.popupSelect2();}
select2Init++;console.log(jQuery('.select2-container--below').length);jQuery('.select2-container--below').remove();that.popupSelect2();}
else{that.popupSelect2();jQuery('.select2-container--below').remove();}
that.closeMediaButtonPopup(popup);});that.insertPopup(popup);});};SGPBMediaButton.prototype.openAskReviewBannerPopup=function()
{var that=this;var select2Init=1;var popupConfigObj=new PopupConfig();popupConfigObj.magicCall('setContentPadding',14);popupConfigObj.magicCall('setContentBorderRadius',4);popupConfigObj.magicCall('setContentBorderRadiusType','px');popupConfigObj.magicCall('setShadowSpread',14);popupConfigObj.magicCall('setOverlayAddClass','sgpb-theme-1-overlay');popupConfigObj.magicCall('setContentShadowColor','#0009');popupConfigObj.magicCall('setMinWidth',400);popupConfigObj.magicCall('setMaxWidth','700px');popupConfigObj.magicCall('setOverlayShouldClose',false);popupConfigObj.magicCall('setSrcElement','sg-popup-content-wrapper-0');if(jQuery('#sg-popup-content-wrapper-0').length){var config=popupConfigObj.combineConfigObj();var popup=new SGPopup(config);popup.open();}
else{that.closingActions();}
jQuery(window).bind('sgpbDidOpen',function(){that.closingActions(popup);});};SGPBMediaButton.prototype.closingActions=function(popup)
{jQuery('.sg-already-did-review').each(function(){jQuery(this).click(function(){var ajaxData={action:'sgpb_dont_show_review_popup',nonce:SGPB_JS_PARAMS.nonce};jQuery.post(SGPB_JS_PARAMS.url,ajaxData,function(res){if(typeof popup!='undefined'){popup.close();}
if(jQuery('.sgpb-review-popup-banner-wrapper').length){jQuery('.sgpb-review-popup-banner-wrapper').remove();}});});});jQuery('.sg-you-worth-it').each(function(){jQuery(this).click(function(){var ajaxData={action:'sgpb_dont_show_review_popup',nonce:SGPB_JS_PARAMS.nonce};jQuery.post(SGPB_JS_PARAMS.url,ajaxData,function(res){if(typeof popup!='undefined'){popup.close();}
if(jQuery('.sgpb-review-popup-banner-wrapper').length){jQuery('.sgpb-review-popup-banner-wrapper').remove();}
window.location=SGPB_JS_EXTENSIONS_PARAMS.reviewUrl;});});});jQuery('.sg-show-popup-period').click(function(){var messageType=jQuery(this).attr('data-message-type');var ajaxData={action:'sgpb_change_review_popup_show_period',messageType:messageType,nonce:SGPB_JS_PARAMS.nonce};jQuery.post(SGPB_JS_PARAMS.url,ajaxData,function(res){if(typeof popup!='undefined'){popup.close();}
if(jQuery('.sgpb-review-popup-banner-wrapper').length){jQuery('.sgpb-review-popup-banner-wrapper').remove();}})});jQuery('.sgpb-dont-show-ask-review-popup').click(function(){var ajaxData={action:'sgpb_hide_ask_review_popup',nonce:SGPB_JS_PARAMS.nonce};jQuery.post(SGPB_JS_PARAMS.url,ajaxData,function(res){if(res){popup.close();}})});}
SGPBMediaButton.prototype.closeMediaButtonPopup=function(popup)
{jQuery('.sgpb-close-media-popup-js').on('click',function(){popup.close();});};SGPBMediaButton.prototype.closeReviewPopup=function(popup)
{jQuery('.sgpb-button-2').on('click',function(){popup.close();});};SGPBMediaButton.prototype.insertPopup=function(popup)
{var insidePopup=false;if(mediaButtonParams.currentPostType==mediaButtonParams.popupBuilderPostType){insidePopup=true;}
jQuery('.sgpb-insert-popup-js').bind('click',function(){var selectedPopup=jQuery('.sgpb-insert-popup').val();var selectedPopupEvent=jQuery('.sgpb-insert-popup-event').val();if(typeof selectedPopupEvent!='undefined'){selectedPopupEvent=' event="'+selectedPopupEvent+'"';}
else{selectedPopupEvent='';if(insidePopup){selectedPopupEvent=' insidePopup="on"';}}
if(selectedPopup==''||selectedPopup==null){popup.close();return;}
if(selectedPopupEvent=='onLoad'&&!insidePopup){window.send_to_editor('[sg_popup id="'+selectedPopup+'"'+selectedPopupEvent+'][/sg_popup]');popup.close();return;}
if(typeof tinyMCE.editors.content!='undefined'&&(document.getElementById('content').offsetParent===null)){selectedContent=(tinyMCE.activeEditor.selection.getContent())?tinyMCE.activeEditor.selection.getContent():'';}
else{var content=document.getElementById('content');var selectedContent;if(typeof document.selection!='undefined'){content.focus();var sel=document.selection.createRange();selectedContent=sel.text;}
else if(typeof content.selectionStart!='undefined'){var startPos=content.selectionStart;var endPos=content.selectionEnd;selectedContent=content.value.substring(startPos,endPos)}}
window.send_to_editor('[sg_popup id="'+selectedPopup+'"'+selectedPopupEvent+']'+selectedContent+'[/sg_popup]');popup.close();});jQuery('.sgpb-insert-js-variable-to-editor').bind('click',function(){var jsVariableSelector=jQuery('.sgpb-js-variable-selector').val();var jsVariableAttribute=jQuery('.sgpb-js-variable-attribute').val();jQuery('.sgpb-js-variable-errors').addClass('sg-hide-element');var valid=true;if(jsVariableSelector==''){valid=false;jQuery('.sgpb-js-variable-selector-error').removeClass('sg-hide-element');}
if(jsVariableAttribute==''){valid=false;jQuery('.sgpb-js-variable-attribute-error').removeClass('sg-hide-element');}
if(!valid){return false;}
jQuery('.sgpb-js-variable-errors').addClass('sg-hide-element');window.send_to_editor('[pbvariable selector="'+jsVariableSelector+'" attribute="'+jsVariableAttribute+'"]');popup.close();});};SGPBMediaButton.prototype.popupSelect2=function()
{if(!jQuery('.js-sg-select2').length){return;}
jQuery('select.js-sg-select2').each(function(){var type=jQuery(this).attr('data-select-type');var className=jQuery(this).attr('data-select-class');var options={width:'100%'};if(type=='ajax'){if(typeof SGPB_JS_PARAMS=='undefined'){return;}
options=jQuery.extend(options,{minimumInputLength:1,ajax:{url:SGPB_JS_PARAMS.url,dataType:'json',delay:250,type:'POST',data:function(params){var searchKey=jQuery(this).attr('data-value-param');return{action:'select2_search_data',nonce_ajax:SGPB_JS_PARAMS.nonce,searchTerm:params.term,searchKey:searchKey};},processResults:function(data){return{results:jQuery.map(data.items,function(item){return{text:item.text,id:item.id}})};}}});}
jQuery(this).sgpbselect2(options);});};jQuery(document).ready(function(){var mediaButton=new SGPBMediaButton();mediaButton.init();});