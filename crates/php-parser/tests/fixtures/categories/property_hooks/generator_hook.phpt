===source===
<?php
class A {
    public $backed = 2 {
        get {
            yield 1;
            yield from [$this->backed];
        }
    }
    public $short { get => yield 1; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===ast===
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
                    "name": "backed",
                    "span": {
                      "start": 27,
                      "end": 34
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
                      "start": 37,
                      "end": 38
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 73,
                                        "end": 74
                                      }
                                    },
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 67,
                                  "end": 74
                                }
                              }
                            },
                            "span": {
                              "start": 67,
                              "end": 75
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Array": [
                                          {
                                            "key": null,
                                            "kind": {
                                              "Value": {
                                                "kind": {
                                                  "PropertyAccess": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "this"
                                                      },
                                                      "span": {
                                                        "start": 100,
                                                        "end": 105
                                                      }
                                                    },
                                                    "property": {
                                                      "kind": {
                                                        "Identifier": "backed"
                                                      },
                                                      "span": {
                                                        "start": 107,
                                                        "end": 113
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 100,
                                                  "end": 113
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 100,
                                              "end": 113
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 99,
                                        "end": 114
                                      }
                                    },
                                    "is_from": true
                                  }
                                },
                                "span": {
                                  "start": 88,
                                  "end": 114
                                }
                              }
                            },
                            "span": {
                              "start": 88,
                              "end": 115
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 49,
                        "end": 125
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 131
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "short",
                    "span": {
                      "start": 143,
                      "end": 149
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
                            "Yield": {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 165,
                                  "end": 166
                                }
                              },
                              "is_from": false
                            }
                          },
                          "span": {
                            "start": 159,
                            "end": 166
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 152,
                        "end": 167
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 136,
                "end": 169
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 171
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 171
  }
}
