import {__} from '@wordpress/i18n';
import {
	__experimentalText as Text,
	__experimentalBorderControl as BorderControl,
	SelectControl,
	RangeControl,
	Panel,
	PanelBody,
	ColorPalette,
	PanelRow
} from '@wordpress/components';
import {useSelect} from "@wordpress/data";
import {useState} from '@wordpress/element';

const ButtonSettings = ({options}) => {

	const {attributes, setAttributes} = options;
	const [ color, setColor ] = useState ()
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

	return (
		<Panel>
			<PanelBody
				title={__('Button Settings', 'flr-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<RangeControl
						label={__('Button Border Radius', 'flr-blocks')}
						value={attributes.buttonBorderRadius}
						onChange={(val) =>
							setAttributes({buttonBorderRadius: val})
						}
						min={0}
						max={25}
					/>
				</PanelRow>
				<PanelRow>
					<BorderControl
						label={__('Button Border', 'flr-blocks')}
						onChange={(newButtonBorder) =>
							setAttributes({
								buttonBorder: newButtonBorder,
							})
						}
						value={attributes.buttonBorder}
					/>
				</PanelRow>
				<PanelRow>
					<Text>
						{__('Button Background Color', 'flr-blocks')}
					</Text>
				</PanelRow>
				<PanelRow>
					<ColorPalette
						colors={colors}
						value={color}
						onChange={(color) =>{
								setColor(color)
								setAttributes({buttonBgColor: color})
							}
						}
					/>
				</PanelRow>
				<PanelRow>
					<SelectControl
						labelPosition={'top'}
						label={__('Button Font Weight', 'flr-blocks')}
						value={attributes.buttonTextFontWeight}
						options={[
							{label: 'Normal', value: 'normal'},
							{label: 'Bold', value: 'bold'},
						]}
						onChange={(val) =>
							setAttributes({buttonTextFontWeight: val})
						}
					/>
				</PanelRow>
				<PanelRow>
					<Text>{__('Button Text Color', 'flr-blocks')}</Text>
				</PanelRow>
				<PanelRow>
					<ColorPalette
						colors={colors}
						value={attributes.buttonTextColor}
						onChange={(val) =>
							setAttributes({buttonTextColor: val})
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default ButtonSettings;
