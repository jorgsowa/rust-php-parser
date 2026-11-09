import { astNodes, type AstNode } from '../../data/ast-nodes'

export const DOC_GROUPS = [
  'Control Flow',
  'Define Code',
  'Output/Communication',
  'Variables & Values',
  'Operations',
  'Function/Method Calls',
  'Class/Object Operations',
  'Declarations',
  'Types',
  'Other Expressions',
  'Components',
]

const groupRank = (group: string) => {
  const i = DOC_GROUPS.indexOf(group)
  return i === -1 ? DOC_GROUPS.length : i
}

// Stable sort keeps the data file's order inside each group, so list and prev/next agree.
export const orderedNodes: AstNode[] = [...astNodes].sort(
  (a, b) => groupRank(a.group) - groupRank(b.group),
)

export function isAvailableIn(node: AstNode, version: string): boolean {
  if (!node.phpVersion) return true
  return parseFloat(version) >= parseFloat(node.phpVersion)
}

export function nodeHref(node: AstNode): string {
  return `#docs/${node.id}`
}

// Helper nodes win name clashes (StaticVar): field types refer to the helper, not the statement.
const nodeByTypeName = new Map<string, AstNode>()
for (const node of astNodes) {
  if (!nodeByTypeName.has(node.name) || node.id.startsWith('helper-')) nodeByTypeName.set(node.name, node)
}

export function nodeForTypeName(name: string): AstNode | undefined {
  return nodeByTypeName.get(name)
}
