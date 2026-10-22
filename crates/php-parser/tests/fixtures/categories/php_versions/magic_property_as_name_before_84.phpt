===source===
<?php
echo __PROPERTY__;
const __PROPERTY__ = 1;
function __PROPERTY__() {} __property__();
class __PROPERTY__ {} new __PROPERTY__;
echo __PROPERTY__::class, \__PROPERTY__, A\__PROPERTY__;
class C { public $p = __PROPERTY__; }
function f(__PROPERTY__ $x) {}
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "__PROPERTY__", expecting identifier in Standard input code on line 3
===ast 8.3===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Name": {
                "parts": [
                  "__PROPERTY__"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            },
            "span": {
              "start": 11,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "__PROPERTY__",
              "span": {
                "start": 31,
                "end": 43
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 46,
                "end": 47
              }
            },
            "attributes": [],
            "span": {
              "start": 31,
              "end": 47
            }
          }
        ]
      },
      "span": {
        "start": 25,
        "end": 48
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "__PROPERTY__",
            "span": {
              "start": 58,
              "end": 70
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 49,
        "end": 75
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
                      "__property__"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 76,
                      "end": 88
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 88
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 76,
            "end": 90
          }
        }
      },
      "span": {
        "start": 76,
        "end": 91
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "__PROPERTY__",
            "span": {
              "start": 98,
              "end": 110
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
        "start": 92,
        "end": 113
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "__PROPERTY__"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 118,
                      "end": 130
                    }
                  }
                },
                "span": {
                  "start": 118,
                  "end": 130
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 114,
            "end": 130
          }
        }
      },
      "span": {
        "start": 114,
        "end": 131
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "__PROPERTY__"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 137,
                        "end": 149
                      }
                    }
                  },
                  "span": {
                    "start": 137,
                    "end": 149
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 151,
                    "end": 156
                  }
                }
              }
            },
            "span": {
              "start": 137,
              "end": 156
            }
          },
          {
            "kind": {
              "Name": {
                "parts": [
                  "__PROPERTY__"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 158,
                  "end": 171
                }
              }
            },
            "span": {
              "start": 158,
              "end": 171
            }
          },
          {
            "kind": {
              "Name": {
                "parts": [
                  "A",
                  "__PROPERTY__"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 173,
                  "end": 187
                }
              }
            },
            "span": {
              "start": 173,
              "end": 187
            }
          }
        ]
      },
      "span": {
        "start": 132,
        "end": 188
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 195,
              "end": 196
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
                      "start": 206,
                      "end": 208
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
                          "__PROPERTY__"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 211,
                          "end": 223
                        }
                      }
                    },
                    "span": {
                      "start": 211,
                      "end": 223
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 199,
                "end": 223
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 189,
        "end": 226
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 236,
              "end": 237
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 251,
                  "end": 253
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "__PROPERTY__"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 238,
                      "end": 250
                    }
                  }
                },
                "span": {
                  "start": 238,
                  "end": 250
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 238,
                "end": 253
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
        "start": 227,
        "end": 257
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 257
  }
}
