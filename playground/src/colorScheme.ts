import { useEffect, useState } from 'react'

export const COLOR_SCHEMES = ['system', 'light', 'dark'] as const
export type ColorScheme = (typeof COLOR_SCHEMES)[number]

// Keep in sync with the inline script in index.html, which applies the scheme before first paint.
const STORAGE_KEY = 'color-scheme'
const lightQuery = window.matchMedia('(prefers-color-scheme: light)')

function readStored(): ColorScheme {
  try {
    const v = localStorage.getItem(STORAGE_KEY)
    if (v === 'light' || v === 'dark') return v
  } catch { /* storage blocked */ }
  return 'system'
}

function apply(scheme: ColorScheme) {
  const resolved = scheme === 'system' ? (lightQuery.matches ? 'light' : 'dark') : scheme
  document.documentElement.dataset.theme = resolved
}

export function useColorScheme(): [ColorScheme, (s: ColorScheme) => void] {
  const [scheme, setScheme] = useState<ColorScheme>(readStored)

  useEffect(() => {
    apply(scheme)
    try {
      if (scheme === 'system') localStorage.removeItem(STORAGE_KEY)
      else localStorage.setItem(STORAGE_KEY, scheme)
    } catch { /* storage blocked */ }
    if (scheme !== 'system') return
    const onChange = () => apply('system')
    lightQuery.addEventListener('change', onChange)
    return () => lightQuery.removeEventListener('change', onChange)
  }, [scheme])

  return [scheme, setScheme]
}
