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
          "name": {
            "name": "Proxy",
            "span": {
              "start": 131,
              "end": 136
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
                "Property": {
                  "name": {
                    "name": "data",
                    "span": {
                      "start": 193,
                      "end": 198
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                  "name": {
                    "name": "oldMethod",
                    "span": {
                      "start": 305,
                      "end": 314
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                "end": 325
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
