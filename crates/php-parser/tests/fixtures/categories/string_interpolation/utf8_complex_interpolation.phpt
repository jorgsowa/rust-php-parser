===source===
<?php
class Класс {
    public $свойство = "prop";
}
$объект = new Класс();
echo "Complex: {$объект->свойство}";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Класс",
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
                  "name": "свойство",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "prop"
                    },
                    "span": {
                      "start": 56,
                      "end": 62
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "объект"
                },
                "span": {
                  "start": 66,
                  "end": 79
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Класс"
                      },
                      "span": {
                        "start": 86,
                        "end": 96
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 82,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 98
          }
        }
      },
      "span": {
        "start": 66,
        "end": 99
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Complex: "
                },
                {
                  "Expr": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "объект"
                          },
                          "span": {
                            "start": 116,
                            "end": 129
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "свойство"
                          },
                          "span": {
                            "start": 131,
                            "end": 147
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 116,
                      "end": 147
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 105,
              "end": 149
            }
          }
        ]
      },
      "span": {
        "start": 100,
        "end": 150
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150
  }
}
