/**
 * The starting designs offered on a block's setup screen.
 *
 * One definition feeds four places: the setup placeholder, the block variations
 * in the inserter, the Design dropdown in the block toolbar, and the preview
 * miniatures. Keeping them in a single file rather than one per preset is
 * deliberate -- they only stay a coherent set if they can be read side by side.
 *
 * A preset is nothing but a bundle of attributes, including core block support
 * attributes under `style`. Applying one is a plain setAttributes call, and the
 * author can change every value afterwards.
 *
 * Transparency must be written as 8 digit hex. Core's style attribute filter
 * discards any declaration still holding rgba(), so a preset using it would look
 * right in the editor and lose the value on the published page.
 */

import { __ } from '@wordpress/i18n';

export const PRESETS = [
	{
		name: 'minimal',
		title: __( 'Minimal', 'frontend-login-and-registration-blocks' ),
		description: __(
			'No card, hairline fields and a solid dark button.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'minimal',
			templateChosen: true,
			layoutStyles: { fieldGap: '1rem' },
			labelStyles: { fontSize: '0.8125rem', fontWeight: '600' },
			inputStyles: {
				radius: '4px',
				paddingBlock: '0.55rem',
				border: { color: '#d0d5dd', style: 'solid', width: '1px' },
				focusBorderColor: '#1e1e1e',
				focusShadow: '0 0 0 2px #1e1e1e1f',
			},
			buttonStyles: {
				bg: '#1e1e1e',
				color: '#ffffff',
				radius: '4px',
				width: '100%',
				fontWeight: '600',
				bgHover: '#3c434a',
			},
			linkStyles: { fontSize: '0.8125rem' },
		},
	},

	{
		name: 'card',
		title: __( 'Card', 'frontend-login-and-registration-blocks' ),
		description: __(
			'A centred white card lifted off the page by a soft shadow.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'card',
			templateChosen: true,
			style: {
				color: { background: '#ffffff', text: '#1e1e1e' },
				spacing: {
					padding: {
						top: '2rem',
						right: '2rem',
						bottom: '2rem',
						left: '2rem',
					},
				},
				border: {
					radius: '12px',
					color: '#e5e7eb',
					style: 'solid',
					width: '1px',
				},
			},
			layoutStyles: {
				maxWidth: '440px',
				fieldGap: '1.25rem',
				cardShadow: '0 10px 30px #0000001a',
			},
			labelStyles: {
				fontSize: '0.875rem',
				fontWeight: '600',
				color: '#3c434a',
			},
			inputStyles: {
				radius: '8px',
				paddingBlock: '0.65rem',
				paddingInline: '0.85rem',
				border: { color: '#dcdcde', style: 'solid', width: '1px' },
				focusBorderColor: '#3858e9',
				focusShadow: '0 0 0 3px #3858e926',
			},
			buttonStyles: {
				bg: '#3858e9',
				color: '#ffffff',
				radius: '8px',
				fontWeight: '600',
				paddingBlock: '0.75rem',
				width: '100%',
				bgHover: '#2145e6',
			},
			linkStyles: {
				fontSize: '0.8125rem',
				color: '#3858e9',
				decorationHover: 'underline',
			},
			checkStyles: { accent: '#3858e9' },
			noticeStyles: { radius: '8px' },
			fieldOptions: { showLabels: true, showPlaceholders: true },
		},
	},

	{
		name: 'soft',
		title: __( 'Soft', 'frontend-login-and-registration-blocks' ),
		description: __(
			'Generous rounding, muted greys and a pill shaped button.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'soft',
			templateChosen: true,
			style: {
				color: { background: '#f9fafb', text: '#111827' },
				spacing: {
					padding: {
						top: '1.75rem',
						right: '1.75rem',
						bottom: '1.75rem',
						left: '1.75rem',
					},
				},
				border: { radius: '20px' },
			},
			layoutStyles: { maxWidth: '420px', fieldGap: '1.15rem' },
			labelStyles: {
				fontSize: '0.8125rem',
				fontWeight: '500',
				color: '#6b7280',
			},
			inputStyles: {
				bg: '#ffffff',
				radius: '12px',
				paddingBlock: '0.7rem',
				paddingInline: '1rem',
				border: { color: '#e5e7eb', style: 'solid', width: '1px' },
				focusBorderColor: '#111827',
				focusShadow: '0 0 0 3px #1118270f',
			},
			buttonStyles: {
				bg: '#111827',
				color: '#ffffff',
				radius: '999px',
				paddingBlock: '0.8rem',
				fontWeight: '600',
				width: '100%',
				bgHover: '#374151',
			},
			linkStyles: { fontSize: '0.8125rem', color: '#6b7280' },
			checkStyles: { accent: '#111827' },
			noticeStyles: { radius: '12px' },
		},
	},

	{
		name: 'dark',
		title: __( 'Dark', 'frontend-login-and-registration-blocks' ),
		description: __(
			'A dark panel with light text and a bright accent.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'dark',
			templateChosen: true,
			style: {
				color: { background: '#111827', text: '#e5e7eb' },
				spacing: {
					padding: {
						top: '2rem',
						right: '2rem',
						bottom: '2rem',
						left: '2rem',
					},
				},
				border: { radius: '14px' },
			},
			layoutStyles: {
				maxWidth: '440px',
				fieldGap: '1.2rem',
				cardShadow: '0 12px 32px #00000059',
			},
			labelStyles: {
				fontSize: '0.8125rem',
				fontWeight: '600',
				color: '#d1d5db',
			},
			inputStyles: {
				bg: '#1f2937',
				color: '#f9fafb',
				radius: '8px',
				paddingBlock: '0.7rem',
				border: { color: '#374151', style: 'solid', width: '1px' },
				placeholderColor: '#9ca3af',
				focusBorderColor: '#60a5fa',
				focusShadow: '0 0 0 3px #60a5fa33',
			},
			buttonStyles: {
				bg: '#60a5fa',
				color: '#0b1220',
				radius: '8px',
				paddingBlock: '0.75rem',
				fontWeight: '700',
				width: '100%',
				bgHover: '#93c5fd',
			},
			linkStyles: {
				fontSize: '0.8125rem',
				color: '#93c5fd',
				decorationHover: 'underline',
			},
			checkStyles: { accent: '#60a5fa', labelColor: '#d1d5db' },
			noticeStyles: {
				radius: '8px',
				successBg: '#052e1a',
				successColor: '#a7f3d0',
				successBorder: '#065f46',
				errorBg: '#3f1214',
				errorColor: '#fecaca',
				errorBorder: '#991b1b',
				loadingColor: '#9ca3af',
			},
		},
	},

	{
		name: 'outline',
		title: __( 'Outline', 'frontend-login-and-registration-blocks' ),
		description: __(
			'Squared off, unfilled fields with heavy borders.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'outline',
			templateChosen: true,
			style: {
				spacing: {
					padding: {
						top: '1.5rem',
						right: '1.5rem',
						bottom: '1.5rem',
						left: '1.5rem',
					},
				},
				border: {
					radius: '0',
					color: '#1e1e1e',
					style: 'solid',
					width: '2px',
				},
			},
			layoutStyles: { maxWidth: '420px', fieldGap: '1.1rem' },
			labelStyles: {
				fontSize: '0.75rem',
				fontWeight: '700',
				textTransform: 'uppercase',
				letterSpacing: '0.08em',
			},
			inputStyles: {
				bg: 'transparent',
				radius: '0',
				paddingBlock: '0.6rem',
				border: { color: '#1e1e1e', style: 'solid', width: '2px' },
				focusBorderColor: '#3858e9',
				focusShadow: 'none',
			},
			buttonStyles: {
				bg: 'transparent',
				color: '#1e1e1e',
				radius: '0',
				paddingBlock: '0.7rem',
				fontWeight: '700',
				textTransform: 'uppercase',
				letterSpacing: '0.06em',
				width: '100%',
				border: { color: '#1e1e1e', style: 'solid', width: '2px' },
				bgHover: '#1e1e1e',
				colorHover: '#ffffff',
			},
			linkStyles: { fontSize: '0.75rem', decoration: 'underline' },
			noticeStyles: { radius: '0' },
		},
	},

	{
		name: 'underline',
		title: __( 'Underline', 'frontend-login-and-registration-blocks' ),
		description: __(
			'Fields reduced to a single rule, with small caps labels.',
			'frontend-login-and-registration-blocks'
		),
		attributes: {
			preset: 'underline',
			templateChosen: true,
			layoutStyles: { maxWidth: '400px', fieldGap: '1.4rem' },
			labelStyles: {
				fontSize: '0.6875rem',
				fontWeight: '600',
				textTransform: 'uppercase',
				letterSpacing: '0.1em',
				color: '#6b7280',
			},
			inputStyles: {
				bg: 'transparent',
				radius: '0',
				paddingBlock: '0.45rem',
				border: { color: '#9ca3af', style: 'solid', width: '2px' },
				focusBorderColor: '#1e1e1e',
			},
			buttonStyles: {
				bg: '#1e1e1e',
				color: '#ffffff',
				radius: '2px',
				paddingBlock: '0.7rem',
				fontWeight: '600',
				width: '100%',
				bgHover: '#3c434a',
			},
			linkStyles: { fontSize: '0.75rem', color: '#6b7280' },
			checkStyles: { accent: '#1e1e1e' },
			fieldOptions: { showPlaceholders: true },
		},
	},
];

/** Every style and option group a preset may write, for a clean reset. */
export const PRESET_GROUPS = [
	'style',
	'layoutStyles',
	'labelStyles',
	'inputStyles',
	'buttonStyles',
	'linkStyles',
	'checkStyles',
	'noticeStyles',
	'descriptionStyles',
	'avatarStyles',
];

/**
 * Look a preset up by name.
 *
 * @param {string} name Preset name.
 * @return {Object|undefined} The preset.
 */
export function getPreset( name ) {
	return PRESETS.find( ( preset ) => preset.name === name );
}

/**
 * Attributes that clear every design choice without touching content settings.
 *
 * fieldOptions is left alone on purpose: which fields a form shows is a content
 * decision the author made, not part of the look.
 *
 * @return {Object} Attributes to pass to setAttributes.
 */
export function resetDesignAttributes() {
	const cleared = { preset: '' };

	PRESET_GROUPS.forEach( ( group ) => {
		cleared[ group ] = undefined;
	} );

	return cleared;
}
