(()=>{"use strict";var e,t={510:()=>{const e=window.wp.blocks,t=window.React,l=window.wp.blockEditor,o=window.wp.i18n,r=window.wp.element,n=window.wp.components,a=({options:e})=>{const{attributes:t,setAttributes:l}=e;return(0,r.createElement)(n.Panel,null,(0,r.createElement)(n.PanelBody,{title:(0,o.__)("Label Settings","flr-blocks"),initialOpen:!1},(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.ToggleControl,{label:(0,o.__)("Show labels","flr-blocks"),help:t.showLabels?"Show":"Hide",checked:t.showLabels,onChange:e=>l({showLabels:e})})),(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.SelectControl,{labelPosition:"top",label:(0,o.__)("Font Weight & Font Color","flr-blocks"),value:t.textFontWeight,options:[{label:"Normal",value:"normal"},{label:"Bold",value:"bold"}],onChange:e=>l({textFontWeight:e})})),(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.ColorPicker,{color:t.textColor,onChange:e=>l({textColor:e}),enableAlpha:!0,defaultValue:"#000"}))))},s=({options:e})=>{const{attributes:t,setAttributes:l}=e;return(0,r.createElement)(n.Panel,null,(0,r.createElement)(n.PanelBody,{title:(0,o.__)("Input Settings","flr-blocks"),initialOpen:!1},(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.RangeControl,{label:(0,o.__)("Input Border Radius","flr-blocks"),value:t.inputBorderRadius,onChange:e=>l({inputBorderRadius:e}),min:0,max:25})),(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.ToggleControl,{label:(0,o.__)("Show Placeholders","flr-blocks"),help:t.showPlaceholders?"Show":"Hide",checked:t.showPlaceholders,onChange:e=>l({showPlaceholders:e})}))))},c=window.wp.data,i=({options:e})=>{const{attributes:l,setAttributes:a}=e,[s,i]=(0,r.useState)(),[u,b]=(0,r.useState)([]);return(0,c.useSelect)((e=>{const t=e("core").getCurrentTheme(),l=`/wp-content/themes/${t.stylesheet}/theme.json`;fetch(l).then((e=>{if(!e.ok)throw new Error("Network response was not ok");return e.json()})).then((e=>{if(t.is_block_theme){const t=e.settings.color.palette.map((e=>({color:e.color,name:e.name})));b(t)}})).catch((e=>{console.error("Error fetching the theme.json file:",e)}))}),[]),(0,t.createElement)(n.Panel,null,(0,t.createElement)(n.PanelBody,{title:(0,o.__)("Button Settings","flr-blocks"),initialOpen:!1},(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.RangeControl,{label:(0,o.__)("Button Border Radius","flr-blocks"),value:l.buttonBorderRadius,onChange:e=>a({buttonBorderRadius:e}),min:0,max:25})),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.__experimentalBorderControl,{label:(0,o.__)("Button Border","flr-blocks"),onChange:e=>a({buttonBorder:e}),value:l.buttonBorder})),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.__experimentalText,null,(0,o.__)("Button Background Color","flr-blocks"))),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.ColorPalette,{colors:u,value:s,onChange:e=>{i(e),a({buttonBgColor:e})}})),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.SelectControl,{labelPosition:"top",label:(0,o.__)("Button Font Weight","flr-blocks"),value:l.buttonTextFontWeight,options:[{label:"Normal",value:"normal"},{label:"Bold",value:"bold"}],onChange:e=>a({buttonTextFontWeight:e})})),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.__experimentalText,null,(0,o.__)("Button Text Color","flr-blocks"))),(0,t.createElement)(n.PanelRow,null,(0,t.createElement)(n.ColorPalette,{colors:u,value:l.buttonTextColor,onChange:e=>a({buttonTextColor:e})}))))},u=({options:e})=>{const{attributes:t,setAttributes:c}=e;return(0,r.createElement)(l.InspectorControls,null,(0,r.createElement)(a,{options:e}),(0,r.createElement)(s,{options:e}),(0,r.createElement)(i,{options:e}),(0,r.createElement)(n.Panel,null,(0,r.createElement)(n.PanelBody,{title:(0,o.__)("Description Settings","flr-blocks"),initialOpen:!1},(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.ToggleControl,{label:(0,o.__)("Show Description","flr-blocks"),help:t.showPlaceholders?"Show":"Hide",checked:t.showDescription,onChange:e=>c({showDescription:e})})),(0,r.createElement)(n.PanelRow,null,(0,r.createElement)(n.TextareaControl,{label:"Description",value:t.description,onChange:e=>c({description:e})})))))},b=JSON.parse('{"u2":"frontend-login-with-gutenberg-blocks/reset-password-form"}');(0,e.registerBlockType)(b.u2,{edit:function(e){const{attributes:r,setAttributes:n}=e,a=(0,l.useBlockProps)(e),s={"border-radius":r.inputBorderRadius},c={color:r.textColor,"font-weight":r.textFontWeight},i={color:r.buttonTextColor,backgroundColor:r.buttonBgColor,"border-color":r.buttonBorder.color,"border-style":r.buttonBorder.style,"border-width":r.buttonBorder.width,"border-radius":r.buttonBorderRadius,"font-weight":r.buttonTextFontWeight},b=r.description?r.description:"Please enter your e-mail address. We will send you an e-mail to reset your password.",m={cursor:"pointer",border:"1px solid gray",padding:"5px","text-decoration":"none"};return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(u,{options:e}),(0,t.createElement)("div",{...a},(0,t.createElement)("div",{style:{display:"flex","justify-content":"center","align-items":"center",gap:"15px","margin-bottom":"30px"}},(0,t.createElement)("a",{style:m,onClick:()=>n({selectedForm:"requestForm"})},(0,o.__)("Step 1","flr-blocks")),(0,t.createElement)("a",{style:m,onClick:()=>n({selectedForm:"changePasswordForm"})},(0,o.__)("Step 2","flr-blocks"))),"requestForm"===r.selectedForm&&(0,t.createElement)("div",null,(0,t.createElement)("p",{style:{"text-align":"center","font-weight":"bold"}},(0,o.__)("Password Reset Request Form","flr-blocks")),r.showDescription&&(0,t.createElement)("div",{style:{"text-align":"center"}},(0,t.createElement)("p",null,(0,o.__)(b,"flr-blocks"))),(0,t.createElement)("div",{className:"flr-blocks-form-row"},(0,t.createElement)("div",{className:"flr-blocks-input-group"},r.showLabels&&(0,t.createElement)("label",{className:"flr-blocks-input-label",style:c,htmlFor:"flr-blocks-email"},(0,o.__)("Your e-mail","flr-blocks")),(0,t.createElement)("input",{className:"flr-blocks-input-control",id:"flr-blocks-email",type:"text",style:s,placeholder:r.showPlaceholders&&(0,o.__)("Enter your e-mail","flr-blocks")}))),(0,t.createElement)("div",{className:"flr-blocks-form-row"},(0,t.createElement)("button",{style:i,type:"submit",name:"wp-submit",id:"wp-submit",className:"flr-blocks-reset-password-btn flr-blocks-btn wp-block-button__link wp-element-button"},(0,o.__)("Send Request","flr-blocks")))),"changePasswordForm"===r.selectedForm&&(0,t.createElement)("div",null,(0,t.createElement)("p",{style:{"text-align":"center","font-weight":"bold"}},(0,o.__)("Change Password Form","flr-blocks")),(0,t.createElement)("div",{className:"flr-blocks-form-row"},(0,t.createElement)("div",{className:"flr-blocks-input-group"},r.showLabels&&(0,t.createElement)("label",{className:"flr-blocks-input-label",style:c,htmlFor:"flr-blocks-password"},(0,o.__)("Password","flr-blocks")),(0,t.createElement)("input",{className:"flr-blocks-input-control",id:"flr-blocks-password",type:"password",style:s,placeholder:r.showPlaceholders&&(0,o.__)("Enter your password","flr-blocks")}))),(0,t.createElement)("div",{className:"flr-blocks-form-row"},(0,t.createElement)("div",{className:"flr-blocks-input-group"},r.showLabels&&(0,t.createElement)("label",{className:"flr-blocks-input-label",style:c,htmlFor:"flr-blocks-password-again"},(0,o.__)("Password Again","flr-blocks")),(0,t.createElement)("input",{className:"flr-blocks-input-control",id:"flr-blocks-password-again",type:"password",style:s,placeholder:r.showPlaceholders&&(0,o.__)("Enter your password again","flr-blocks")}))),(0,t.createElement)("div",{className:"flr-blocks-form-row"},(0,t.createElement)("button",{style:i,type:"submit",name:"wp-submit-pwd",id:"wp-submit-pwd",className:"flr-blocks-reset-password-btn flr-blocks-btn wp-block-button__link wp-element-button"},(0,o.__)("Change Password","flr-blocks"))))))},save:function(){}})}},l={};function o(e){var r=l[e];if(void 0!==r)return r.exports;var n=l[e]={exports:{}};return t[e](n,n.exports,o),n.exports}o.m=t,e=[],o.O=(t,l,r,n)=>{if(!l){var a=1/0;for(u=0;u<e.length;u++){for(var[l,r,n]=e[u],s=!0,c=0;c<l.length;c++)(!1&n||a>=n)&&Object.keys(o.O).every((e=>o.O[e](l[c])))?l.splice(c--,1):(s=!1,n<a&&(a=n));if(s){e.splice(u--,1);var i=r();void 0!==i&&(t=i)}}return t}n=n||0;for(var u=e.length;u>0&&e[u-1][2]>n;u--)e[u]=e[u-1];e[u]=[l,r,n]},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={411:0,810:0};o.O.j=t=>0===e[t];var t=(t,l)=>{var r,n,[a,s,c]=l,i=0;if(a.some((t=>0!==e[t]))){for(r in s)o.o(s,r)&&(o.m[r]=s[r]);if(c)var u=c(o)}for(t&&t(l);i<a.length;i++)n=a[i],o.o(e,n)&&e[n]&&e[n][0](),e[n]=0;return o.O(u)},l=globalThis.webpackChunkfrontend_login_with_gutenberg_blocks=globalThis.webpackChunkfrontend_login_with_gutenberg_blocks||[];l.forEach(t.bind(null,0)),l.push=t.bind(null,l.push.bind(l))})();var r=o.O(void 0,[810],(()=>o(510)));r=o.O(r)})();