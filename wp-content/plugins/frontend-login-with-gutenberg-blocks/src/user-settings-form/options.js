import {InspectorControls} from '@wordpress/block-editor';
import LabelSettings from "../components/LabelSettings";
import ButtonSettings from "../components/ButtonSettings";
import InputSettings from "../components/InputSettings";

const Options = ({options}) => {

	return (
		<InspectorControls>

			<LabelSettings options={options} />

			<InputSettings options={options}/>

			<ButtonSettings options={options}/>

		</InspectorControls>
	)

}

export default Options;
