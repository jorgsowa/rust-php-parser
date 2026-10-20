===source===
<?php
class A {
    public $p { get { class B {} return 1; } }
    public function f() {
        interface I {}
        if (true) { trait T {} }
        $c = function () { enum E {} };
        $o = new class {
            public function g() { class C {} }
        };
    }
}
enum F {
    public function h() { class D {} }
}
===errors >=8.4===
Class declarations may not be nested
Class declarations may not be nested
Class declarations may not be nested
Class declarations may not be nested
Class declarations may not be nested
Class declarations may not be nested
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Class declarations may not be nested in Standard input code on line 3
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "p",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Class": {
                                "name": {
                                  "name": "B",
                                  "span": {
                                    "start": 44,
                                    "end": 45
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
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 38,
                              "end": 48
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 56,
                                  "end": 57
                                }
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 58
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 60
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 62
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 83,
                      "end": 84
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Interface": {
                          "name": {
                            "name": "I",
                            "span": {
                              "start": 107,
                              "end": 108
                            }
                          },
                          "extends": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 111
                      }
                    },
                    {
                      "kind": {
                        "If": {
                          "condition": {
                            "kind": {
                              "Bool": true
                            },
                            "span": {
                              "start": 124,
                              "end": 128
                            }
                          },
                          "then_branch": {
                            "kind": {
                              "Block": [
                                {
                                  "kind": {
                                    "Trait": {
                                      "name": {
                                        "name": "T",
                                        "span": {
                                          "start": 138,
                                          "end": 139
                                        }
                                      },
                                      "members": [],
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 132,
                                    "end": 142
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 130,
                              "end": 144
                            }
                          },
                          "elseif_branches": [],
                          "else_branch": null
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 144
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 153,
                                  "end": 155
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [],
                                    "use_vars": [],
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "Enum": {
                                            "name": {
                                              "name": "E",
                                              "span": {
                                                "start": 177,
                                                "end": 178
                                              }
                                            },
                                            "scalar_type": null,
                                            "implements": [],
                                            "members": [],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 172,
                                          "end": 181
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 158,
                                  "end": 183
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 153,
                            "end": 183
                          }
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 184
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "o"
                                },
                                "span": {
                                  "start": 193,
                                  "end": 195
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "AnonymousClass": {
                                          "name": null,
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
                                                "Method": {
                                                  "name": {
                                                    "name": "g",
                                                    "span": {
                                                      "start": 238,
                                                      "end": 239
                                                    }
                                                  },
                                                  "modifiers": {
                                                    "visibility": "Public"
                                                  },
                                                  "by_ref": false,
                                                  "params": [],
                                                  "return_type": null,
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Class": {
                                                          "name": {
                                                            "name": "C",
                                                            "span": {
                                                              "start": 250,
                                                              "end": 251
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
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 244,
                                                        "end": 254
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 222,
                                                "end": 256
                                              }
                                            }
                                          ],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 198,
                                        "end": 266
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 198,
                                  "end": 266
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 193,
                            "end": 266
                          }
                        }
                      },
                      "span": {
                        "start": 193,
                        "end": 267
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 67,
                "end": 273
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 275
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 281,
              "end": 282
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 305,
                      "end": 306
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Class": {
                          "name": {
                            "name": "D",
                            "span": {
                              "start": 317,
                              "end": 318
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
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 311,
                        "end": 321
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 289,
                "end": 323
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 276,
        "end": 325
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 325
  }
}
