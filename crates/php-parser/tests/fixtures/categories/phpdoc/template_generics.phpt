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
          "name": {
            "name": "Collection",
            "span": {
              "start": 75,
              "end": 85
            }
          },
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
                  "name": {
                    "name": "add",
                    "span": {
                      "start": 169,
                      "end": 172
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "item",
                        "span": {
                          "start": 180,
                          "end": 185
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 173,
                              "end": 179
                            }
                          }
                        },
                        "span": {
                          "start": 173,
                          "end": 179
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
                        "end": 185
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
                          "end": 193
                        }
                      }
                    },
                    "span": {
                      "start": 188,
                      "end": 193
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @param T $item\n     * @return list<T>\n     */",
                    "span": {
                      "start": 92,
                      "end": 148
                    }
                  }
                }
              },
              "span": {
                "start": 153,
                "end": 196
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @template T of object\n * @template-covariant TValue\n */",
            "span": {
              "start": 6,
              "end": 68
            }
          }
        }
      },
      "span": {
        "start": 69,
        "end": 198
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 198
  }
}
