===source===
<?php #[Attr('positional', key: 'value', flag: true)] class Foo {}
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 66
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 60,
              "end": 63
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "positional"
                      },
                      "span": {
                        "start": 13,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 25
                  }
                },
                {
                  "name": {
                    "parts": [
                      "key"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "value"
                      },
                      "span": {
                        "start": 32,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 39
                  }
                },
                {
                  "name": {
                    "parts": [
                      "flag"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 47,
                        "end": 51
                      }
                    }
                  },
                  "span": {
                    "start": 41,
                    "end": 51
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
