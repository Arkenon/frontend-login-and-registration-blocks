import { useState } from "@wordpress/element";
import { useSelect } from "@wordpress/data";
import { ColorPalette, __experimentalBorderControl as BorderControl, } from "@wordpress/components";
import {__} from "@wordpress/i18n";

function getThemeColors(){
	const [colors, setColors] = useState([]);
	useSelect((select) => {
		const getThemeData = select('core').getCurrentTheme();
		const themeJsonPath = `/wp-content/themes/${getThemeData.stylesheet}/theme.json`;

		fetch(themeJsonPath)
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				return response.json();
			})
			.then(themeJson => {
				if (getThemeData.is_block_theme) {
					const palettes = themeJson.settings.color.palette;
					const newColors = palettes.map(palette => ({
						color: palette.color,
						name: palette.name,
					}));

					setColors(newColors);

				}
			})
			.catch(error => {
				console.error('Error fetching the theme.json file:', error);
			});
	}, []);

	return colors;
}


export const FlrColorPalette = ({ options, attributeName }) => {
	const { attributes, setAttributes } = options;
	const colors = getThemeColors();
	return (
		<ColorPalette
			colors={colors}
			value={attributes[attributeName]}
			onChange={(color) => setAttributes({ [attributeName]: color })}
		/>
	)
}


export const FlrBorderControl = ({ options, attributeName }) => {
	const { attributes, setAttributes } = options;
	const colors = getThemeColors();
	return (
		<BorderControl
			colors={colors}
			label={__('Button Border', 'flr-blocks')}
			onChange={(newButtonBorder) =>{

				if(newButtonBorder !=undefined){
					setAttributes({
						[attributeName]: newButtonBorder,
					})
				}
			}

			}
			value={attributes[attributeName]}
		/>
	)
}

