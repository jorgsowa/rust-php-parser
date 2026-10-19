===config===
min_php=8.5
===source===
<?php

const X = 'x';

class P {
    public $prop;
}

class C extends P {
    public $prop = X {
        get => 'y';
    }
}

var_dump((new C)->prop);

?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 13,
                "end": 14
              }
            },
            "value": {
              "kind": {
                "String": "x"
              },
              "span": {
                "start": 17,
                "end": 20
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 21
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
            "span": {
              "start": 29,
              "end": 30
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
                    "name": "prop",
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 23,
        "end": 52
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 60,
              "end": 61
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 70,
              "end": 71
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 85,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "X"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 93,
                          "end": 94
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "String": "y"
                          },
                          "span": {
                            "start": 112,
                            "end": 115
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 105,
                        "end": 116
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 78,
                "end": 122
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 54,
        "end": 124
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 126,
                      "end": 134
                    }
                  }
                },
                "span": {
                  "start": 126,
                  "end": 134
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 140,
                                            "end": 141
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 140,
                                        "end": 141
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 136,
                                  "end": 141
                                }
                              }
                            },
                            "span": {
                              "start": 135,
                              "end": 142
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "prop"
                            },
                            "span": {
                              "start": 144,
                              "end": 148
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 135,
                        "end": 148
                      }
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 148
                  }
                }
              ]
            }
          },
          "span": {
            "start": 126,
            "end": 149
          }
        }
      },
      "span": {
        "start": 126,
        "end": 150
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150
  }
}
