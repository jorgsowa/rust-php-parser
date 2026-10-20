===source===
<?php

class A {
    public $prop = 1;
}

class B extends A {
    public $prop = 2 { get => parent::$prop::get() * 2; }
}

class C extends B {
    public $prop = 3;
}
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 8
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
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 48,
              "end": 49
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
              "start": 58,
              "end": 59
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
                      "start": 73,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 81,
                      "end": 82
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 92,
                                                  "end": 98
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 92,
                                              "end": 98
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "prop"
                                            },
                                            "span": {
                                              "start": 100,
                                              "end": 105
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 92,
                                        "end": 105
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 107,
                                        "end": 110
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 92,
                                  "end": 112
                                }
                              },
                              "op": "Mul",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 115,
                                  "end": 116
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 116
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 85,
                        "end": 117
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 66,
                "end": 119
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 121
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 129,
              "end": 130
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 139,
              "end": 140
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
                      "start": 154,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 162,
                      "end": 163
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 147,
                "end": 163
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 123,
        "end": 166
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 166
  }
}
