===source===
<?php
class Point {
    public readonly float $x;
    public readonly float $y;
    public function __construct(float $x, float $y) {
        $this->x = $x;
        $this->y = $y;
    }
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
'readonly properties' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'float' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "float", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 12,
              "end": 17
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
                    "name": "x",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 76,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 70,
                          "end": 75
                        }
                      }
                    },
                    "span": {
                      "start": 70,
                      "end": 75
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 78
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 100,
                      "end": 111
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 118,
                          "end": 120
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 112,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 112,
                          "end": 117
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 112,
                        "end": 120
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 128,
                          "end": 130
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 122,
                              "end": 127
                            }
                          }
                        },
                        "span": {
                          "start": 122,
                          "end": 127
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 122,
                        "end": 130
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
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
                                        "start": 142,
                                        "end": 147
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "x"
                                      },
                                      "span": {
                                        "start": 149,
                                        "end": 150
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 142,
                                  "end": 150
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 153,
                                  "end": 155
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 142,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 156
                      }
                    },
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
                                        "start": 165,
                                        "end": 170
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "y"
                                      },
                                      "span": {
                                        "start": 172,
                                        "end": 173
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 165,
                                  "end": 173
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 176,
                                  "end": 178
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 165,
                            "end": 178
                          }
                        }
                      },
                      "span": {
                        "start": 165,
                        "end": 179
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 185
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 187
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187
  }
}
