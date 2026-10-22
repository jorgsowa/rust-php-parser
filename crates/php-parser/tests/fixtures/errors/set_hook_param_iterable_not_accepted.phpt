===source===
<?php
class C {
    public iterable $a { set(array $v) {} }
    public iterable $b { set(Traversable $v) {} }
}
===errors===
Type of parameter $v of hook C::$a::set must be compatible with property type
Type of parameter $v of hook C::$b::set must be compatible with property type
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook C::$a::set must be compatible with property type in Standard input code on line 3
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
                    "name": "a",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 35
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 51,
                              "end": 53
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "array"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 45,
                                  "end": 50
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 50
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 45,
                            "end": 53
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 57
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 59
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 80,
                      "end": 82
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 71,
                          "end": 79
                        }
                      }
                    },
                    "span": {
                      "start": 71,
                      "end": 79
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 101,
                              "end": 103
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 89,
                                  "end": 100
                                }
                              }
                            },
                            "span": {
                              "start": 89,
                              "end": 100
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 89,
                            "end": 103
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 85,
                        "end": 107
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 64,
                "end": 109
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 111
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 111
  }
}
