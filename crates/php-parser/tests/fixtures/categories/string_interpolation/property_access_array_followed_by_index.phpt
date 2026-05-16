===source===
<?php
class Foo {
    public array $items = ['a', 'b'];
}
$obj = new Foo();
// Simple syntax: ->prop[n] is NOT supported; [0] becomes literal text
echo "$obj->items[0]";
// Complex syntax: needed to actually index the array
echo "{$obj->items[0]}";
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
                  "name": "items",
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
                          "start": 29,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 45,
                              "end": 48
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 45,
                            "end": 48
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 50,
                              "end": 53
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 50,
                            "end": 53
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 44,
                      "end": 54
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
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
                  "start": 58,
                  "end": 62
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
                        "start": 69,
                        "end": 72
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 65,
                  "end": 74
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 74
          }
        }
      },
      "span": {
        "start": 58,
        "end": 75
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
                            "start": 153,
                            "end": 157
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "items"
                          },
                          "span": {
                            "start": 159,
                            "end": 164
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 164
                    }
                  }
                },
                {
                  "Literal": "[0]"
                }
              ]
            },
            "span": {
              "start": 152,
              "end": 168
            }
          }
        ]
      },
      "span": {
        "start": 147,
        "end": 169
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
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "obj"
                                },
                                "span": {
                                  "start": 231,
                                  "end": 235
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "items"
                                },
                                "span": {
                                  "start": 237,
                                  "end": 242
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 231,
                            "end": 242
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 243,
                            "end": 244
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 231,
                      "end": 245
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 229,
              "end": 247
            }
          }
        ]
      },
      "span": {
        "start": 224,
        "end": 248
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 248
  }
}
