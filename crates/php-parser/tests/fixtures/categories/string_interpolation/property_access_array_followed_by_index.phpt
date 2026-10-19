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
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "items",
                    "span": {
                      "start": 35,
                      "end": 41
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
                          "kind": {
                            "Value": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 45,
                                "end": 48
                              }
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 48
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 50,
                                "end": 53
                              }
                            }
                          },
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
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 69,
                            "end": 72
                          }
                        }
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
