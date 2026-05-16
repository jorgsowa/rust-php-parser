import { useState, useEffect, useCallback } from 'react'

export type Route =
  | { page: 'playground' }
  | { page: 'docs' }
  | { page: 'docs-node'; nodeId: string }
  | { page: 'compare' }
  | { page: 'stats' }
  | { page: 'stats-project'; slug: string }

function parseHash(hash: string): Route {
  const path = hash.replace(/^#/, '')

  if (!path || path === 'playground') return { page: 'playground' }
  if (path === 'docs')    return { page: 'docs' }
  if (path === 'compare') return { page: 'compare' }
  if (path === 'stats')   return { page: 'stats' }

  if (path.startsWith('docs/')) {
    const nodeId = path.slice(5)
    if (nodeId) return { page: 'docs-node', nodeId }
  }

  if (path.startsWith('stats/')) {
    const slug = path.slice(6)
    if (slug) return { page: 'stats-project', slug }
  }

  return { page: 'playground' }
}

export function routeToHash(route: Route): string {
  switch (route.page) {
    case 'playground':    return '#'
    case 'docs':          return '#docs'
    case 'docs-node':     return `#docs/${route.nodeId}`
    case 'compare':       return '#compare'
    case 'stats':         return '#stats'
    case 'stats-project': return `#stats/${route.slug}`
  }
}

export function useRoute(): [Route, (route: Route) => void] {
  const [route, setRoute] = useState<Route>(() =>
    parseHash(window.location.hash)
  )

  const navigate = useCallback((newRoute: Route) => {
    window.location.hash = routeToHash(newRoute)
  }, [])

  useEffect(() => {
    const handleHashChange = () => {
      setRoute(parseHash(window.location.hash))
    }

    window.addEventListener('hashchange', handleHashChange)
    return () => window.removeEventListener('hashchange', handleHashChange)
  }, [])

  return [route, navigate]
}
