const fs = require('fs');

const css_string = `
        .about-us { width: 100%; position: relative; background-color: #fff; overflow: hidden; display: flex; flex-direction: column; align-items: flex-start; isolation: isolate; text-align: left; font-size: 14px; color: #fff; font-family: Inter; }
        .hero { width: 1440px; height: 552px; position: relative; background-color: #000; overflow: hidden; flex-shrink: 0; z-index: 0; text-align: center; }
        .rectangle-parent { position: absolute; top: 0px; left: 0px; background-color: #edeff7; width: 1440px; height: 550px; overflow: hidden; flex-shrink: 0; }
        .frame-child { position: absolute; top: 0px; left: calc(50% - 720px); width: 1440px; height: 626px; object-fit: contain; flex-shrink: 0; }
        .frame-item { position: absolute; top: 0px; left: calc(50% - 720px); background: rgba(4, 70, 242, 0.38), rgba(0, 5, 26, 0.49); width: 1440px; height: 626px; flex-shrink: 0; }
        .hero-inner { position: absolute; top: 60px; left: 100px; width: 1240px; height: 492px; display: flex; flex-direction: column; align-items: flex-start; padding: 92px 0px 84px; box-sizing: border-box; flex-shrink: 0; }
        .frame-parent { align-self: stretch; display: flex; flex-direction: column; align-items: center; gap: 28px; }
        .rectangle-group { display: flex; align-items: center; gap: 8px; }
        .frame-inner { height: 8px; width: 8px; position: relative; background-color: #0446f2; }
        .our-philosophy { position: relative; line-height: 120%; text-transform: uppercase; font-weight: 500; }
        .led-by-practitioners { width: 1032px; position: relative; font-size: 72px; line-height: 110%; font-family: Outfit; display: inline-block; }
        .vector-icon { position: absolute; right: 0px; bottom: -32px; width: 653px; height: 125px; object-fit: contain; opacity: 0.6; flex-shrink: 0; }
        .middle { width: 1440px; height: 4727px; background-color: #fff; display: flex; flex-direction: column; align-items: flex-start; padding: 150px 0px 1px; box-sizing: border-box; z-index: 1; color: #00051a; }
        .frame-group { align-self: stretch; height: 820px; position: relative; background-color: #fff; overflow-y: auto; flex-shrink: 0; min-height: 820px; text-align: center; }
        .frame-container { position: absolute; top: 0px; left: 100px; width: 1240px; height: 344px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 44px; }
        .we-are-operators { align-self: stretch; position: relative; font-size: 52px; line-height: 110%; font-family: Outfit; }
        .valuecast-partners-was-container { width: 1040px; position: relative; font-size: 20px; line-height: 140%; display: inline-block; opacity: 0.84; }
        .frame-icon { position: absolute; top: 344px; left: 100px; border-radius: 16px; width: 1240px; height: 430px; object-fit: cover; }
        .cards { width: 1440px; height: 600px; display: flex; flex-direction: column; align-items: flex-start; flex-shrink: 0; font-size: 36px; }
        .component-17 { align-self: stretch; height: 600px; background-color: #f5f6fc; display: flex; align-items: flex-end; }
        .frame-parent2 { align-self: stretch; flex: 1; border-radius: 40px; display: flex; align-items: flex-start; }
        .group-wrapper { align-self: stretch; width: 730px; position: relative; overflow: hidden; flex-shrink: 0; }
        .group-icon { position: absolute; top: 55px; left: 100px; width: 610px; height: 482px; object-fit: cover; }
        .our-story-parent { align-self: stretch; flex: 1; display: flex; flex-direction: column; align-items: flex-start; justify-content: center; padding: 48px 96px; gap: 36px; }
        .our-story { align-self: stretch; position: relative; line-height: 120%; font-weight: 600; }
        .we-believe-middle-market { align-self: stretch; position: relative; font-size: 18px; line-height: 120%; font-weight: 500; opacity: 0.8; }
        .middle-inner { align-self: stretch; height: 938px; position: relative; background-color: #fff; overflow-y: auto; flex-shrink: 0; min-height: 820px; text-align: center; color: #fff; }
        .frame-wrapper { position: absolute; top: 0px; left: 0px; background-color: #00051a; width: 1440px; height: 938px; overflow: hidden; display: flex; flex-direction: column; align-items: flex-start; padding: 56px 100px; box-sizing: border-box; isolation: isolate; }
        .frame-parent3 { width: 1240px; height: 896px; position: absolute; margin: 0 !important; top: 28px; left: calc(50% - 620px); z-index: 0; flex-shrink: 0; }
        .frame-parent4 { position: absolute; top: 0px; left: 0px; width: 1240px; display: flex; flex-direction: column; align-items: flex-end; }
        .frame-parent5 { align-self: stretch; height: 271px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 44px; }
        .our-india-based-global { width: 1240px; position: relative; font-size: 20px; line-height: 140%; display: inline-block; opacity: 0.84; }
        .box-parent { align-self: stretch; display: flex; align-items: flex-start; flex-wrap: wrap; align-content: flex-start; gap: 28px 25px; font-size: 18px; }
        .box { height: 225px; width: 396px; backdrop-filter: blur(116px); border-radius: 12px; background-color: rgba(255, 255, 255, 0.2); display: flex; flex-direction: column; align-items: center; padding: 28px 24px; box-sizing: border-box; gap: 20px; }
        .caretleft-icon { width: 16px; height: 16px; position: relative; display: none; flex-shrink: 0; }
        .h { width: 212px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 25px; flex-shrink: 0; }
        .performance-media-icon { width: 44px; height: 44px; position: relative; }
        .performance-marketing { align-self: stretch; position: relative; line-height: 120%; font-weight: 500; }
        .accusamus-et-iusto { align-self: stretch; position: relative; font-size: 16px; line-height: 120%; flex-shrink: 0; }
        .box2 { height: 225px; width: 396px; backdrop-filter: blur(116px); border-radius: 12px; background-color: #0446f2; display: flex; flex-direction: column; align-items: center; padding: 28px 24px; box-sizing: border-box; gap: 12px; }
        .h2 { width: 212px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; flex-shrink: 0; }
        .box3 { height: 225px; width: 396px; backdrop-filter: blur(116px); border-radius: 12px; background-color: rgba(255, 255, 255, 0.2); display: flex; flex-direction: column; align-items: center; padding: 28px 24px; box-sizing: border-box; gap: 20px; font-size: 10px; }
        .vector-icon2 { position: absolute; width: 84.09%; top: calc(50% - 19px); right: 6.82%; left: 9.09%; max-width: 100%; overflow: hidden; height: 37px; }
        .div { position: absolute; top: 15px; left: 13px; line-height: 120%; font-weight: 900; }
        .web-development { align-self: stretch; position: relative; font-size: 18px; line-height: 120%; font-weight: 500; }
        .vector-icon3 { position: absolute; height: 84.32%; width: 75%; top: 7.8%; right: 14.06%; bottom: 7.88%; left: 10.94%; max-width: 100%; overflow: hidden; max-height: 100%; }
        .this-engine-enables { position: absolute; top: 813px; left: calc(50% - 620px); font-size: 20px; line-height: 140%; display: inline-block; width: 1240px; opacity: 0.84; }
        .get-to-know-us { width: 1440px; height: 630px; position: relative; background-color: #cfe1ff; overflow: hidden; flex-shrink: 0; font-size: 18px; }
        .mask-group-icon { position: absolute; top: 93px; left: 205px; width: 445px; height: 420px; object-fit: cover; }
        .rectangle-parent3 { position: absolute; top: 93px; left: 734px; display: flex; align-items: center; gap: 8px; text-align: center; font-size: 14px; }
        .driving-innovation-and { position: absolute; top: 127px; left: 731px; font-size: 36px; line-height: 120%; font-weight: 600; display: inline-block; width: 600px; }
        .get-to-know-us-child { position: absolute; top: 333px; left: 731px; border-radius: 10px; background-color: #fff; width: 236px; height: 180px; }
        .vision { position: absolute; top: 352px; left: 751px; line-height: 120%; font-weight: 600; display: inline-block; width: 96px; }
        .to-build-the { position: absolute; top: 387px; left: 751px; font-size: 12px; line-height: 140%; font-weight: 500; display: inline-block; width: 195px; opacity: 0.8; }
        .group-div { position: absolute; top: 333px; left: 999px; width: 236px; height: 180px; color: #fff; }
        .group-child { position: absolute; top: 0px; left: 0px; border-radius: 10px; background-color: #0446f2; width: 236px; height: 180px; }
        .mission { position: absolute; top: 19px; left: 20px; line-height: 120%; font-weight: 600; display: inline-block; width: 96px; }
        .to-empower-visionary { position: absolute; top: 54px; left: 20px; font-size: 12px; line-height: 140%; font-weight: 500; display: inline-block; width: 195px; opacity: 0.8; }
        .our-team { width: 1440px; height: 1674px; position: relative; background-color: #fff; overflow: hidden; flex-shrink: 0; font-size: 12px; }
        .our-team2 { position: absolute; top: 90px; left: 663px; display: flex; align-items: center; gap: 8px; text-align: center; font-size: 14px; }
        .success-stories-fuel-our-innov-wrapper { position: absolute; top: 113px; left: calc(50% - 323px); display: flex; align-items: center; justify-content: center; padding: 10px; text-align: center; font-size: 36px; }
        .success-stories-fuel { position: relative; line-height: 120%; font-weight: 600; }
        .rectangle-parent4 { position: absolute; top: 204px; left: 205px; width: 484px; display: flex; flex-direction: column; align-items: center; gap: 13px; }
        .rectangle-icon { align-self: stretch; position: relative; border-radius: 10px; max-width: 100%; overflow: hidden; max-height: 100%; object-fit: cover; }
        .mr-founder-name { width: 434px; position: relative; font-size: 20px; line-height: 120%; font-weight: 600; display: inline-block; }
        .designation { width: 434px; position: relative; line-height: 120%; font-weight: 600; color: #c3c6d2; display: inline-block; }
        .founder-business { width: 434px; height: 63px; position: relative; line-height: 120%; display: inline-block; flex-shrink: 0; }
        .rectangle-parent5 { position: absolute; top: 204px; left: 751px; width: 484px; display: flex; flex-direction: column; align-items: center; gap: 13px; }
        .our-team-inner { position: absolute; top: 790px; left: 0px; background-color: #f8f8f8; width: 1440px; height: 799px; }
        .group-parent { position: absolute; top: 70px; left: 63.53px; width: 1312.9px; height: 410px; }
        .group-item { position: absolute; top: 170px; left: 0px; width: 70px; height: 70px; }
        .name-sirname-parent { position: absolute; top: 0px; left: 120px; width: 230.5px; height: 410px; }
        .name-sirname { position: absolute; top: 295px; left: 0px; font-size: 20px; line-height: 120%; font-weight: 600; }
        .designation3 { position: absolute; top: 323px; left: 0px; line-height: 120%; font-weight: 600; }
        .builds-scalable-businesses { position: absolute; top: 347px; left: 0px; line-height: 120%; display: inline-block; width: 225px; height: 63px; }
        .group-inner { position: absolute; top: 0px; left: 0.47px; border-radius: 10px; width: 230px; height: 280px; object-fit: cover; }
        .name-sirname-group { position: absolute; top: 0px; left: 400.47px; width: 230.5px; height: 410px; }
        .name-sirname-container { position: absolute; top: 0px; left: 680.95px; width: 231px; height: 410px; }
        .drives-business-expansion { position: absolute; top: 347px; left: 0px; line-height: 120%; display: inline-block; width: 208px; height: 63px; }
        .group-child3 { position: absolute; top: 0px; left: 0.47px; border-radius: 10px; width: 230.5px; height: 280px; object-fit: cover; }
        .name-sirname-parent2 { position: absolute; top: 0px; left: 961.95px; width: 231px; height: 410px; }
        .group-child5 { position: absolute; top: 170px; left: 1242.95px; border-radius: 35px; width: 70px; height: 70px; }
        .interested-being-a { position: absolute; top: 1332px; left: calc(50% - 255px); font-size: 36px; line-height: 120%; font-weight: 600; text-align: center; display: inline-block; width: 510px; height: 86px; }
        .buttonwhite-about { position: absolute; top: 1470px; left: calc(50% - 179px); border-radius: 120px; background-color: #0446f2; height: 54px; display: flex; align-items: center; justify-content: center; padding: 4px 8px 4px 32px; box-sizing: border-box; gap: 16px; font-size: 18px; color: #fff; font-family: Outfit; white-space: nowrap; text-decoration: none !important; }
        .caretleft-icon7 { height: 16px; width: 16px; position: relative; display: none; }
        .write-to-our { position: relative; line-height: 120%; text-transform: uppercase; }
        .buttonwhite-child { width: 38px; border-radius: 72px; max-height: 100%; }
        .line { width: 1440px; height: 150px; margin: 0 !important; position: absolute; top: 552px; left: calc(50% - 720px); background-color: #fff; display: flex; align-items: center; justify-content: flex-end; padding: 12px 100px; box-sizing: border-box; z-index: 4; font-size: 76px; color: #bcbfcc; font-family: Outfit; overflow:hidden;}
        .our-work { width: 1920px; display: flex; align-items: center; gap: 40px; flex-shrink: 0; }
        .who-we-are2 { position: relative; line-height: 100%; text-transform: lowercase; opacity: 0.9; flex-shrink: 0; }
        .who-we-are3 { position: relative; line-height: 100%; text-transform: lowercase; font-weight: 200; color: #0446f2; flex-shrink: 0; }
`;

// Scope with .vcc-about-page
let scoped_css = css_string.replace(/(^|\n|\r)\s*\.([a-zA-Z0-9_-]+)/g, '$1.vcc-about-page .$2');

fs.writeFileSync('C:/Users/admin/OneDrive - ValueCast Partners/Desktop/GCC_Website/app/public/wp-content/themes/techbiz-valuecast/assets/css/about-us.css', '/* Scoped About Us Styles */\n' + scoped_css);
