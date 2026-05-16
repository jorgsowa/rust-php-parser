===source===
<?php
class Foo {
    public string $parameterName = 'test';
}
$obj = new Foo();
echo "$obj->parameterName[]";
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
                  "name": "parameterName",
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
                          "start": 29,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 35
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 53,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 63,
                  "end": 67
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 74,
                        "end": 77
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 70,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 79
          }
        }
      },
      "span": {
        "start": 63,
        "end": 80
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 87,
                            "end": 91
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "parameterName"
                          },
                          "span": {
                            "start": 93,
                            "end": 106
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 87,
                      "end": 106
                    }
                  }
                },
                {
                  "Literal": "[]"
                }
              ]
            },
            "span": {
              "start": 86,
              "end": 109
            }
          }
        ]
      },
      "span": {
        "start": 81,
        "end": 110
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 110
  }
}
