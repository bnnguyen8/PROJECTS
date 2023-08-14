// const { getDefaultConfig } = require('metro-config');

// module.exports = (async () => {
//   const {
//     resolver: { sourceExts },
//   } = await getDefaultConfig();
//   return {
//     transformer: {
//       getTransformOptions: async () => ({
//         transform: {
//           experimentalImportSupport: false,
//           inlineRequires: true,
//         },
//       }),
//     },
//     resolver: {
//       sourceExts: [...sourceExts, 'cjs'],
//     },
//   };
// })();

const { getDefaultConfig } = require('@expo/metro-config');
const defaultConfig = getDefaultConfig(__dirname);
defaultConfig.resolver.assetExts.push('cjs');
module.exports = defaultConfig;