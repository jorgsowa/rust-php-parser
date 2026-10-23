===source===
<?php
;
/** doc */
declare(ticks=1);
declare(ticks=1) {}
declare(ticks=1): enddeclare;
declare(ticks=(1), strict_types=(1));
declare(STRICT_TYPES=0x1);
declare(strict_types=01);
declare(strict_types=0b0);
?>
<?php declare(strict_types=1) ?>
<?php declare(ticks=<<<E
1
E, ticks=<<<'E'
1
E, ticks='x', ticks=1.5e3);
namespace A;
===errors <=8.4===
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
strict_types declaration must be the very first statement in the script
===php_error <=8.4===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 6,
        "end": 7
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 19,
        "end": 36
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** doc */",
        "span": {
          "start": 8,
          "end": 18
        }
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 51,
                  "end": 52
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 54,
              "end": 56
            }
          }
        }
      },
      "span": {
        "start": 37,
        "end": 56
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 71,
                  "end": 72
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 57,
              "end": 86
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 57,
        "end": 86
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 102,
                      "end": 103
                    }
                  }
                },
                "span": {
                  "start": 101,
                  "end": 104
                }
              }
            ],
            [
              "strict_types",
              {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 120,
                      "end": 121
                    }
                  }
                },
                "span": {
                  "start": 119,
                  "end": 122
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 87,
        "end": 124
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "STRICT_TYPES",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 146,
                  "end": 149
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 125,
        "end": 151
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 173,
                  "end": 175
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 152,
        "end": 177
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 199,
                  "end": 202
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 178,
        "end": 204
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 207,
        "end": 208
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 235,
                  "end": 236
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 214,
        "end": 237
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 240,
        "end": 241
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Heredoc": {
                    "label": "E",
                    "parts": [
                      {
                        "Literal": "1"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 261,
                  "end": 269
                }
              }
            ],
            [
              "ticks",
              {
                "kind": {
                  "Nowdoc": {
                    "label": "E",
                    "value": "1"
                  }
                },
                "span": {
                  "start": 277,
                  "end": 287
                }
              }
            ],
            [
              "ticks",
              {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 295,
                  "end": 298
                }
              }
            ],
            [
              "ticks",
              {
                "kind": {
                  "Float": 1500.0
                },
                "span": {
                  "start": 306,
                  "end": 311
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 247,
        "end": 313
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 324,
              "end": 325
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 314,
        "end": 326
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 326
  }
}
