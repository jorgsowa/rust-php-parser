import { useState, useEffect, useCallback } from 'react'

export type Route =
  | { page: 'playground' }
  | { page: 'docs' }
  | { page: 'docs-node'; nodeId: string }
  | { page: 'compare' }

function parseHash(hash: string): Route {
  // Remove leading '#'
  const path = hash.replace(/^#/, '')

  if (!path || path === 'playground') {
    return { page: 'playground' }
  }

  if (path === 'docs') {
    return { page: 'docs' }
  }

  if (path === 'compare') {
    return { page: 'compare' }
  }

  if (path.startsWith('docs/')) {
    const nodeId = path.slice(5) // Remove 'docs/' prefix
    if (nodeId) {
      return { page: 'docs-node', nodeId }
    }
  }

  return { page: 'playground' }
}

export function routeToHash(route: Route): string {
  switch (route.page) {
    case 'playground':
      return '#'
    case 'docs':
      return '#docs'
    case 'docs-node':
      return `#docs/${route.nodeId}`
    case 'compare':
      return '#compare'
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
