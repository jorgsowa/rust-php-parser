===source===
<?php
class Объект {
    public $свойство = "property";
}
$объект = new Объект();
echo "Value: $объект->свойство";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Объект",
            "span": {
              "start": 12,
              "end": 24
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
                    "name": "свойство",
                    "span": {
                      "start": 38,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "property"
                    },
                    "span": {
                      "start": 58,
                      "end": 68
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
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
                  "start": 72,
                  "end": 85
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Объект"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 92,
                            "end": 104
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 104
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 88,
                  "end": 106
                }
              }
            }
          },
          "span": {
            "start": 72,
            "end": 106
          }
        }
      },
      "span": {
        "start": 72,
        "end": 107
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Value: "
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
                            "start": 121,
                            "end": 134
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "свойство"
                          },
                          "span": {
                            "start": 136,
                            "end": 152
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 121,
                      "end": 152
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 113,
              "end": 153
            }
          }
        ]
      },
      "span": {
        "start": 108,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}
