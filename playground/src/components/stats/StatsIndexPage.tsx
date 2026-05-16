import rawStats from '../../data/project-stats.json'
import { routeToHash } from '../../router'

interface ProjectStats {
  name: string
  slug: string
  repo: string
  version: string
  scanned_dirs: string[]
  files: number
  total_nodes: number
  nodes: Record<string, number>
}

const PROJECTS: ProjectStats[] = rawStats as unknown as ProjectStats[]

const PROJECT_DESC: Record<string, string> = {
  laravel:        'Full-stack web framework with expressive syntax. Powers a large share of the PHP ecosystem with its elegant ORM, routing, and service container.',
  symfony:        'Enterprise-grade component library and full-stack framework. Many PHP frameworks (Laravel, Drupal, Shopware) are built on Symfony components.',
  wordpress:      'The world\'s most widely deployed CMS. Powers ~43% of all websites. Core ships a large amount of procedural PHP alongside modern OOP.',
  drupal:         'Content management framework aimed at complex, structured content sites. Known for its powerful entity system and hook-based architecture.',
  phpunit:        'The de-facto standard testing framework for PHP. Pioneered test-driven development in the PHP community; its patterns shaped the entire ecosystem.',
  composer:       'Dependency manager for PHP — the equivalent of npm or Cargo. Nearly every modern PHP project relies on it to manage packages via Packagist.',
  codeigniter:    'Lightweight MVC framework with a small footprint and minimal configuration. Popular for building simple, fast web applications.',
  'doctrine-orm': 'Object-relational mapper built on the Data Mapper pattern. Provides a database abstraction layer used heavily in Symfony and other frameworks.',
  yii2:           'High-performance PHP framework with built-in caching, security, and scaffolding. Popular in Asia and enterprise environments.',
  cakephp:        'Convention-over-configuration MVC framework. One of the oldest PHP frameworks still actively maintained, known for rapid application development.',
}

function formatNum(n: number): string {
  return n.toLocaleString()
}

export function StatsIndexPage() {
  return (
    <div className="page-stats-index">
      <div className="stats-index-header">
        <h1 className="cmp-title">Project Stats</h1>
        <p className="cmp-subtitle">
          AST node usage across {PROJECTS.length} popular PHP projects.
          Real statistics from {formatNum(PROJECTS.reduce((s, p) => s + p.files, 0))} library PHP files — tests and templates excluded.
        </p>
      </div>

      <div className="stats-index-grid">
        {PROJECTS.map(project => (
          <a
            key={project.slug}
            className="stats-index-card"
            href={routeToHash({ page: 'stats-project', slug: project.slug })}
          >
            <div className="stats-index-card-name">{project.name}</div>
            <div className="stats-index-card-version">{project.version}</div>
            {PROJECT_DESC[project.slug] && (
              <p className="stats-index-card-desc">{PROJECT_DESC[project.slug]}</p>
            )}
            <div className="stats-index-card-meta">
              <span><strong>{formatNum(project.files)}</strong> files</span>
              <span><strong>{formatNum(project.total_nodes)}</strong> nodes</span>
              <span><strong>{Object.keys(project.nodes).filter(k => !/ \(/.test(k)).length}</strong> node types</span>
            </div>
          </a>
        ))}
      </div>
    </div>
  )
}
