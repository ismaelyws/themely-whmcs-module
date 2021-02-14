<div class="sub-heading">
    <span class="primary-bg-color">Appearance</span>
</div>
<div class="themely field-container">
    <div class="row">
      <div class="col-md-12">
        <p style="margin-top:0;"><span class="badge">FREE</span> WordPress Themes <span class="pull-right small"><a href="https://plugin.themely.com" target="_blank">Powered by Themely</a></span></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <p class="text-justify"><strong>Beautiful</strong>, <strong>secure</strong> and <strong>easy-to-use</strong> WordPress themes from the most talented creators around the world. All themes are licensed GNU GPL and completely free for personal or commercial use. <strong>Select the perfect theme</strong> for your new site.</p>
      </div>
      <div class="col-md-4">
        <input type="text" name="search_param" id="search_param" class="form-control search-input themely-loading-animation" placeholder="Search themes...">
        <div id="spinner" class="spinner-border" role="status"></div>
      </div>
    </div>
    <div id="results" class="row search-results">
        {foreach from=$themely item=theme}
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="thumbnail">
            <a href="{$theme.preview_url}?ref=themely" target="_blank"><img src="{$theme.screenshot_url}" title="Preview {$theme.name}" class="w-100 rounded-top"></a>
              <div class="caption">
                <div class="row">
                  <div class="col-xs-6 col-md-6 no-padding-right">
                    <span class="name"><strong>{$theme.name}</strong></span>
                    <span class="author small"><span class="text-muted"><em>by</em></span> {$theme.author}</span>
                  </div>
                  <div class="col-xs-6 col-md-6 text-right no-padding-left">
                    <a href="{$theme.preview_url}?ref=themely" target="_blank" class="btn btn-sm btn-outline" title="Preview {$theme.name}"><i class="fas fa-eye fa-fw"></i></a>
                    <button class="btn btn-sm btn-primary" title="Select {$theme.name}" data-themeurl="{$theme.download_url}" data-themeslug="{$theme.theme_slug}" name="theme">Select</button>
                  </div>
                </div>
              </div>
            </div>
            </div>
        {/foreach}
    </div>
</div>