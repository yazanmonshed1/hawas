var path = require("path");

const CKEditorWebpackPlugin = require('@ckeditor/ckeditor5-dev-webpack-plugin');
const { styles } = require('@ckeditor/ckeditor5-dev-utils');

module.exports = {
  entry: ["babel-polyfill", "./src/index.js"],
  mode: "production",
  resolve: {
    modules: ["node_modules", "./src"],
    alias: {
      "react-dom": path.resolve(__dirname, "./node_modules/react-dom"),
      react: path.resolve(__dirname, "./node_modules/react")
    }
  },
  plugins: [
    new CKEditorWebpackPlugin({
      // See https://ckeditor.com/docs/ckeditor5/latest/features/ui-language.html
      language: 'ar'
    })
  ],
  module: {
    rules: [
      // {
      //   test: /\.svg$/,
      //   include: [/react-images-upload/],
      //   loader: 'file-loader',
      //   options: {
      //     name: '[name].[ext]?[hash]'
      //   }
      // },
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: [
          {
            loader: "babel-loader",
            options: {
              presets: [
                ["@babel/preset-env", { modules: "commonjs" }],
                "@babel/preset-react"
              ]
            }
          }
        ]
      },
      {
        test: /\.(scss|css)$/,
        use: ['style-loader', 'css-loader', 'sass-loader'],
        exclude: /node_modules/,
      },
      {
        test: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
        use: ['raw-loader']
      },
      {
				test: /\.css$/,
				use: [
					{
						loader: 'style-loader',
						options: {
							injectType: 'singletonStyleTag',
							attributes: {
								'data-cke': true
							}
						}
					},
					{
						loader: 'postcss-loader',
						options: styles.getPostCssConfig( {
							themeImporter: {
								themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' )
							},
							minify: true
						} )
					}
				]
			},
      // {
      //   test: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/,
      //   use: [
      //     {
      //       loader: 'style-loader',
      //       options: {
      //         singleton: true
      //       }
      //     },
      //     {
      //       loader: 'postcss-loader',
      //       options: styles.getPostCssConfig({
      //         themeImporter: {
      //           themePath: require.resolve('@ckeditor/ckeditor5-theme-lark')
      //         },
      //         minify: true
      //       })
      //     }
      //   ]
      // },
      // {
      //   test: /\.(s[ac]ss|css)$/i,
      //   use: [
      //     // Creates `style` nodes from JS strings
      //     "style-loader",
      //     // Translates CSS into CommonJS
      //     "css-loader",
      //     // Compiles Sass to CSS
      //     {
      //       loader: "sass-loader",
      //       options: {
      //         sassOptions: {
      //           includePaths: ["./src/assets/scss"]
      //         }
      //       }
      //     }
      //   ]
      // }
    ]
  }
};
