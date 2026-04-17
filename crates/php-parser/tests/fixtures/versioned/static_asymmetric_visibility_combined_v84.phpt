===config===
parse_version=8.4
===source===
<?php
class Foo {
    public static protected(set) int $count = 0;
    public static private(set) string $name = '';
}
===errors===
'asymmetric visibility on static properties' requires PHP 8.5 or higher (targeting PHP 8.4)
'asymmetric visibility on static properties' requires PHP 8.5 or higher (targeting PHP 8.4)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "count",
                  "visibility": "Public",
                  "set_visibility": "Protected",
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 51,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 54
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 65
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 98,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 104
                    }
                  },
                  "default": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 113,
                      "end": 115
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 115
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 118
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118
  }
}
