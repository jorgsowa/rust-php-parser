===source===
<?php
class A {
    public $c { &get => $this->d; set { $this->d = $value; } }
    public $e { &get => $this->e; }
}
abstract class B {
    abstract public $g { &get; set; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
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
                    "name": "c",
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
                                  "Identifier": "d"
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
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 56,
                                              "end": 61
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "d"
                                            },
                                            "span": {
                                              "start": 63,
                                              "end": 64
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 56,
                                        "end": 64
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 67,
                                        "end": 73
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 56,
                                  "end": 73
                                }
                              }
                            },
                            "span": {
                              "start": 56,
                              "end": 74
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 76
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 78
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 90,
                      "end": 92
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
                                  "start": 103,
                                  "end": 108
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "e"
                                },
                                "span": {
                                  "start": 110,
                                  "end": 111
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 103,
                            "end": 111
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 95,
                        "end": 112
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 83,
                "end": 114
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 116
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 132,
              "end": 133
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "g",
                    "span": {
                      "start": 156,
                      "end": 158
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 161,
                        "end": 166
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 167,
                        "end": 171
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 140,
                "end": 173
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 126,
        "end": 175
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 175
  }
}
