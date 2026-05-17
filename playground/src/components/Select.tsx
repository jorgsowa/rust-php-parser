import { useState, useRef, useEffect, useCallback } from 'react'

export interface SelectOption {
  value: string
  label: string
}

interface Props {
  options: SelectOption[]
  value: string
  onChange: (value: string) => void
  className?: string
  'aria-label'?: string
}

export function Select({ options, value, onChange, className = '', 'aria-label': ariaLabel }: Props) {
  const [open, setOpen] = useState(false)
  const [flipped, setFlipped] = useState(false)
  const containerRef = useRef<HTMLDivElement>(null)
  const triggerRef = useRef<HTMLButtonElement>(null)
  const listRef = useRef<HTMLUListElement>(null)
  const selectedRef = useRef<HTMLLIElement>(null)
  const selected = options.find(o => o.value === value)

  // Determine whether to open upward based on available space
  const measureFlip = useCallback(() => {
    if (!triggerRef.current) return
    const rect = triggerRef.current.getBoundingClientRect()
    const spaceBelow = window.innerHeight - rect.bottom
    const spaceAbove = rect.top
    const listHeight = Math.min(options.length * 32 + 8, 240)
    setFlipped(spaceBelow < listHeight && spaceAbove > spaceBelow)
  }, [options.length])

  const openDropdown = () => {
    measureFlip()
    setOpen(true)
  }

  // Scroll selected option into view when list opens
  useEffect(() => {
    if (open && selectedRef.current) {
      selectedRef.current.scrollIntoView({ block: 'nearest' })
    }
  }, [open])

  // Close on outside click or scroll
  useEffect(() => {
    if (!open) return
    const close = (e: MouseEvent) => {
      if (containerRef.current && !containerRef.current.contains(e.target as Node)) {
        setOpen(false)
      }
    }
    const closeOnScroll = (e: Event) => {
      if (listRef.current && listRef.current.contains(e.target as Node)) return
      setOpen(false)
    }
    document.addEventListener('mousedown', close)
    window.addEventListener('scroll', closeOnScroll, true)
    return () => {
      document.removeEventListener('mousedown', close)
      window.removeEventListener('scroll', closeOnScroll, true)
    }
  }, [open])

  const choose = (val: string) => {
    onChange(val)
    setOpen(false)
    triggerRef.current?.focus()
  }

  const handleKey = (e: React.KeyboardEvent) => {
    const idx = options.findIndex(o => o.value === value)
    if (e.key === 'Escape') { setOpen(false); triggerRef.current?.focus(); return }
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault()
      open ? setOpen(false) : openDropdown()
      return
    }
    if (e.key === 'ArrowDown') {
      e.preventDefault()
      if (!open) { openDropdown(); return }
      const next = options[Math.min(idx + 1, options.length - 1)]
      if (next) onChange(next.value)
    }
    if (e.key === 'ArrowUp') {
      e.preventDefault()
      if (!open) { openDropdown(); return }
      const prev = options[Math.max(idx - 1, 0)]
      if (prev) onChange(prev.value)
    }
    if (e.key === 'Tab') setOpen(false)
  }

  return (
    <div
      ref={containerRef}
      className={`custom-select ${open ? 'custom-select--open' : ''} ${flipped ? 'custom-select--flipped' : ''} ${className}`}
      onKeyDown={handleKey}
    >
      <button
        ref={triggerRef}
        type="button"
        className="custom-select-trigger"
        onClick={() => open ? setOpen(false) : openDropdown()}
        aria-haspopup="listbox"
        aria-expanded={open}
        aria-label={ariaLabel}
      >
        <span className="custom-select-value">{selected?.label ?? value}</span>
        <span className="custom-select-arrow" aria-hidden="true">
          <svg width="8" height="5" viewBox="0 0 8 5" fill="currentColor">
            <path d="M0 0l4 5 4-5z"/>
          </svg>
        </span>
      </button>

      {open && (
        <ul
          ref={listRef}
          className="custom-select-list"
          role="listbox"
          aria-label={ariaLabel}
        >
          {options.map(opt => (
            <li
              key={opt.value}
              ref={opt.value === value ? selectedRef : null}
              role="option"
              aria-selected={opt.value === value}
              className={`custom-select-option ${opt.value === value ? 'custom-select-option--selected' : ''}`}
              onMouseDown={e => { e.preventDefault(); choose(opt.value) }}
            >
              {opt.value === value && (
                <span className="custom-select-option-check" aria-hidden="true">✓</span>
              )}
              {opt.label}
            </li>
          ))}
        </ul>
      )}
    </div>
  )
}
