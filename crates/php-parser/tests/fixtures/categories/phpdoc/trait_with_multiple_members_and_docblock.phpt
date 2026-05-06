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
          "name": "MultiMember",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "first",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                  "name": "third",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
