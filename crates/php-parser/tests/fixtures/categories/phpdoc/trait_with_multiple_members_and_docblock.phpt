===source===
<?php

/**
 * Trait with multiple members
 * @psalm-require-extends Base
 */
trait MultiMember {
    /**
     * First method
     */
    public function first() {}

    /**
     * Second property
     */
    public string $prop;

    /**
     * Third method
     */
    public function third() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "MultiMember",
            "span": {
              "start": 83,
              "end": 94
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "first",
                    "span": {
                      "start": 153,
                      "end": 158
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * First method\n     */",
                    "span": {
                      "start": 101,
                      "end": 132
                    }
                  }
                }
              },
              "span": {
                "start": 137,
                "end": 163
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 222,
                      "end": 227
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 215,
                          "end": 221
                        }
                      }
                    },
                    "span": {
                      "start": 215,
                      "end": 221
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Second property\n     */",
                    "span": {
                      "start": 169,
                      "end": 203
                    }
                  }
                }
              },
              "span": {
                "start": 208,
                "end": 227
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "third",
                    "span": {
                      "start": 286,
                      "end": 291
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Third method\n     */",
                    "span": {
                      "start": 234,
                      "end": 265
                    }
                  }
                }
              },
              "span": {
                "start": 270,
                "end": 296
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Trait with multiple members\n * @psalm-require-extends Base\n */",
            "span": {
              "start": 7,
              "end": 76
            }
          }
        }
      },
      "span": {
        "start": 77,
        "end": 298
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 298
  }
}
