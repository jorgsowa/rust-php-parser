===source===
<?php
/**
 * @template T of object
 * @template-covariant TValue
 */
class Collection {
    /**
     * @param T $item
     * @return list<T>
     */
    public function add(object $item): array {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Collection",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "add",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "item",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 173,
                              "end": 179,
                              "start_line": 11,
                              "start_col": 24
                            }
                          }
                        },
                        "span": {
                          "start": 173,
                          "end": 179,
                          "start_line": 11,
                          "start_col": 24
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 173,
                        "end": 185,
                        "start_line": 11,
                        "start_col": 24
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 188,
                          "end": 193,
                          "start_line": 11,
                          "start_col": 39
                        }
                      }
                    },
                    "span": {
                      "start": 188,
                      "end": 193,
                      "start_line": 11,
                      "start_col": 39
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @param T $item\n     * @return list<T>\n     */",
                    "span": {
                      "start": 92,
                      "end": 148,
                      "start_line": 7,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 153,
                "end": 197,
                "start_line": 11,
                "start_col": 4
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @template T of object\n * @template-covariant TValue\n */",
            "span": {
              "start": 6,
              "end": 68,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 69,
        "end": 198,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 198,
    "start_line": 1,
    "start_col": 0
  }
}
