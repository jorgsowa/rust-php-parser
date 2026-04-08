===source===
<?php
/**
 * @property string $name
 * @property-read int $id
 * @property-write bool $active
 * @mixin \App\Helpers\Foo
 */
class Proxy {
    /** @var array<string, mixed> */
    public array $data = [];

    /**
     * @deprecated Use newMethod() instead
     * @return void
     */
    public function oldMethod(): void {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Proxy",
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
                "Property": {
                  "name": "data",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 187,
                          "end": 192
                        }
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 192
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 201,
                      "end": 203
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @var array<string, mixed> */",
                    "span": {
                      "start": 143,
                      "end": 175
                    }
                  }
                }
              },
              "span": {
                "start": 180,
                "end": 203
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "oldMethod",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 318,
                          "end": 322
                        }
                      }
                    },
                    "span": {
                      "start": 318,
                      "end": 322
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @deprecated Use newMethod() instead\n     * @return void\n     */",
                    "span": {
                      "start": 210,
                      "end": 284
                    }
                  }
                }
              },
              "span": {
                "start": 289,
                "end": 326
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @property string $name\n * @property-read int $id\n * @property-write bool $active\n * @mixin \\App\\Helpers\\Foo\n */",
            "span": {
              "start": 6,
              "end": 124
            }
          }
        }
      },
      "span": {
        "start": 125,
        "end": 327
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 327
  }
}
