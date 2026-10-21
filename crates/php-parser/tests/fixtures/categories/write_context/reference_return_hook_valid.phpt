===source===
<?php
class C {
    public $p { &get => $this->q; }
    public $r { get => $this?->q; }
    public $s { &get { return $this->q; } }
}
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 40,
                                  "end": 45
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "q"
                                },
                                "span": {
                                  "start": 47,
                                  "end": 48
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 48
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 49
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 51
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "r",
                    "span": {
                      "start": 63,
                      "end": 65
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
                        "Expression": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 75,
                                  "end": 80
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "q"
                                },
                                "span": {
                                  "start": 83,
                                  "end": 84
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 75,
                            "end": 84
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 68,
                        "end": 85
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 56,
                "end": 87
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "s",
                    "span": {
                      "start": 99,
                      "end": 101
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
                              "Return": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 118,
                                        "end": 123
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "q"
                                      },
                                      "span": {
                                        "start": 125,
                                        "end": 126
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 118,
                                  "end": 126
                                }
                              }
                            },
                            "span": {
                              "start": 111,
                              "end": 127
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 104,
                        "end": 129
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 92,
                "end": 131
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
