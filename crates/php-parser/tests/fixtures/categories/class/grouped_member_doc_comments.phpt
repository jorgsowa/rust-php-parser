===source===
<?php
class A {
    /** p */
    public $p = 1, /** q */ $q;
    const A = 1, /** B */ B = 2;
}
enum E {
    const X = 1, /** Y */ Y = 2;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 7
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 7
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
                    "name": "p",
                    "span": {
                      "start": 40,
                      "end": 42
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
                      "start": 45,
                      "end": 46
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** p */",
                    "span": {
                      "start": 20,
                      "end": 28
                    }
                  }
                }
              },
              "span": {
                "start": 33,
                "end": 46
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 57,
                      "end": 59
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** q */",
                    "span": {
                      "start": 48,
                      "end": 56
                    }
                  }
                }
              },
              "span": {
                "start": 57,
                "end": 59
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 71,
                      "end": 72
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 75,
                      "end": 76
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 65,
                "end": 76
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 87,
                      "end": 88
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 91,
                      "end": 92
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** B */",
                    "span": {
                      "start": 78,
                      "end": 86
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 93
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 95
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 101,
              "end": 102
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 115,
                      "end": 116
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 119,
                      "end": 120
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 109,
                "end": 120
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 131,
                      "end": 132
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 135,
                      "end": 136
                    }
                  },
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** Y */",
                    "span": {
                      "start": 122,
                      "end": 130
                    }
                  }
                }
              },
              "span": {
                "start": 131,
                "end": 137
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 96,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
