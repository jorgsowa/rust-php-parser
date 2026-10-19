===source===
<?php

class A {
    public $prop = 42;
}

class B extends A {
    public $prop = 42 {
        set {}
    }
}

$b = new B;
array_walk($b, function (&$item) {
    var_dump($item);
});

?>
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
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
                      "start": 28,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 41
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 49,
              "end": 50
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 59,
              "end": 60
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
                      "start": 74,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 95,
                        "end": 101
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 67,
                "end": 107
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 109
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 111,
                  "end": 113
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
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 120,
                            "end": 121
                          }
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 121
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 116,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 111,
            "end": 121
          }
        }
      },
      "span": {
        "start": 111,
        "end": 122
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
                      "array_walk"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 123,
                      "end": 133
                    }
                  }
                },
                "span": {
                  "start": 123,
                  "end": 133
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 134,
                        "end": 136
                      }
                    }
                  },
                  "span": {
                    "start": 134,
                    "end": 136
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Closure": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": {
                                "name": "item",
                                "span": {
                                  "start": 149,
                                  "end": 154
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": true,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 148,
                                "end": 154
                              }
                            }
                          ],
                          "use_vars": [],
                          "return_type": null,
                          "body": [
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
                                              "start": 162,
                                              "end": 170
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 162,
                                          "end": 170
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "item"
                                              },
                                              "span": {
                                                "start": 171,
                                                "end": 176
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 171,
                                            "end": 176
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 162,
                                    "end": 177
                                  }
                                }
                              },
                              "span": {
                                "start": 162,
                                "end": 178
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 180
                      }
                    }
                  },
                  "span": {
                    "start": 138,
                    "end": 180
                  }
                }
              ]
            }
          },
          "span": {
            "start": 123,
            "end": 181
          }
        }
      },
      "span": {
        "start": 123,
        "end": 182
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 182
  }
}
