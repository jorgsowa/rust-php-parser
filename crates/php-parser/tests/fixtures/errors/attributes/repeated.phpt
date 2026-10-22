===description===
PHP rejects a non-repeatable built-in attribute listed twice on one declaration, in one group or across groups; the parser reports each repeat.
===source===
<?php
#[Attribute] #[Attribute] class A {}
#[Attribute, Attribute] class B {}
#[AllowDynamicProperties, AllowDynamicProperties] class C {}
#[Deprecated] #[Deprecated] function f() {}
#[DelayedTargetValidation, DelayedTargetValidation] function g() {}
class D {
    #[ReturnTypeWillChange] #[ReturnTypeWillChange] public function m(#[SensitiveParameter] #[SensitiveParameter] $a) {}
}
function h(#[SensitiveParameter, SensitiveParameter] $a) {}
#[\Attribute, ATTRIBUTE] class E {}
===errors <=7.4===
expected variable, found end of file
missing closing ')'
expected '{', found end of file
missing closing '}'
===errors 8.0===
Attribute "Attribute" must not be repeated
Attribute "Attribute" must not be repeated
Attribute "ATTRIBUTE" must not be repeated
===errors 8.1===
Attribute "Attribute" must not be repeated
Attribute "Attribute" must not be repeated
Attribute "ReturnTypeWillChange" must not be repeated
Attribute "ATTRIBUTE" must not be repeated
===errors 8.2-8.3===
Attribute "Attribute" must not be repeated
Attribute "Attribute" must not be repeated
Attribute "AllowDynamicProperties" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ReturnTypeWillChange" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ATTRIBUTE" must not be repeated
===errors 8.4===
Attribute "Attribute" must not be repeated
Attribute "Attribute" must not be repeated
Attribute "AllowDynamicProperties" must not be repeated
Attribute "Deprecated" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ReturnTypeWillChange" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ATTRIBUTE" must not be repeated
===errors >=8.5===
Attribute "Attribute" must not be repeated
Attribute "Attribute" must not be repeated
Attribute "AllowDynamicProperties" must not be repeated
Attribute "Deprecated" must not be repeated
Attribute "DelayedTargetValidation" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ReturnTypeWillChange" must not be repeated
Attribute "SensitiveParameter" must not be repeated
Attribute "ATTRIBUTE" must not be repeated
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) in Standard input code on line 11
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 257,
              "end": 258
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
        "start": 251,
        "end": 383
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 393,
              "end": 394
            }
          },
          "params": [
            {
              "name": null,
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 479,
                "end": 479
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 384,
        "end": 395
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 395
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 38,
              "end": 39
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 21,
                  "end": 30
                }
              },
              "args": [],
              "span": {
                "start": 21,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 32,
        "end": 42
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 73,
              "end": 74
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 45,
                  "end": 54
                }
              },
              "args": [],
              "span": {
                "start": 45,
                "end": 54
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 56,
                  "end": 65
                }
              },
              "args": [],
              "span": {
                "start": 56,
                "end": 65
              }
            }
          ]
        }
      },
      "span": {
        "start": 67,
        "end": 77
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 134,
              "end": 135
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 80,
                  "end": 102
                }
              },
              "args": [],
              "span": {
                "start": 80,
                "end": 102
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 104,
                  "end": 126
                }
              },
              "args": [],
              "span": {
                "start": 104,
                "end": 126
              }
            }
          ]
        }
      },
      "span": {
        "start": 128,
        "end": 138
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 176,
              "end": 177
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 141,
                  "end": 151
                }
              },
              "args": [],
              "span": {
                "start": 141,
                "end": 151
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 155,
                  "end": 165
                }
              },
              "args": [],
              "span": {
                "start": 155,
                "end": 165
              }
            }
          ]
        }
      },
      "span": {
        "start": 167,
        "end": 182
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 244,
              "end": 245
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 185,
                  "end": 208
                }
              },
              "args": [],
              "span": {
                "start": 185,
                "end": 208
              }
            },
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 210,
                  "end": 233
                }
              },
              "args": [],
              "span": {
                "start": 210,
                "end": 233
              }
            }
          ]
        }
      },
      "span": {
        "start": 235,
        "end": 250
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 257,
              "end": 258
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 329,
                      "end": 330
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 375,
                          "end": 377
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "SensitiveParameter"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 333,
                              "end": 351
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 333,
                            "end": 351
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "SensitiveParameter"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 355,
                              "end": 373
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 355,
                            "end": 373
                          }
                        }
                      ],
                      "span": {
                        "start": 331,
                        "end": 377
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "ReturnTypeWillChange"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 267,
                          "end": 287
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 267,
                        "end": 287
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "ReturnTypeWillChange"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 291,
                          "end": 311
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 291,
                        "end": 311
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 265,
                "end": 381
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 251,
        "end": 383
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 393,
              "end": 394
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 437,
                  "end": 439
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 397,
                      "end": 415
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 397,
                    "end": 415
                  }
                },
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 417,
                      "end": 435
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 417,
                    "end": 435
                  }
                }
              ],
              "span": {
                "start": 395,
                "end": 439
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 384,
        "end": 443
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "E",
            "span": {
              "start": 475,
              "end": 476
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 446,
                  "end": 456
                }
              },
              "args": [],
              "span": {
                "start": 446,
                "end": 456
              }
            },
            {
              "name": {
                "parts": [
                  "ATTRIBUTE"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 458,
                  "end": 467
                }
              },
              "args": [],
              "span": {
                "start": 458,
                "end": 467
              }
            }
          ]
        }
      },
      "span": {
        "start": 469,
        "end": 479
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 479
  }
}
