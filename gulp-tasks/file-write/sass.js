var fs = require('fs');

module.exports = function(gulp, callback) {
   if(material == 'material-'){
      return fs.writeFile(config.source.sass + '/core/variables/_variables.scss', "//Auto generated file for material layouts. \n @import \"_material-variables\";", callback);
   }else{
      return fs.writeFile(config.source.sass + '/core/variables/_variables.scss', "//Auto generated file for default layouts. \n @import \"_bootstrap-variables\";", callback);
   }
};