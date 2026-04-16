===source===
<?php
namespace Foo
use A
use function a
use A\{B}
const A = 1
break
break 2
continue
continue 2
return
return 2
echo $a
unset($a)
throw $x
goto label
===errors===
expected ';', found 'use'
expected ';', found 'use'
expected ';', found 'use'
expected ';', found 'const'
expected ';', found 'break'
expected expression
expected ';' after break statement
expected ';' after break statement
expected expression
expected ';' after continue statement
expected ';' after continue statement
expected expression
expected ';' after return statement
expected ';' after return statement
expected ';' after echo statement
expected ';', found 'throw'
expected ';' after throw statement
expected ';', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 25
              }
            }
          ]
        }
      },
      "span": {
        "start": 20,
        "end": 25
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "a"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 40
                }
              },
              "alias": null,
              "span": {
                "start": 39,
                "end": 40
              }
            }
          ]
        }
      },
      "span": {
        "start": 26,
        "end": 40
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 45,
                  "end": 49
                }
              },
              "alias": null,
              "span": {
                "start": 48,
                "end": 49
              }
            }
          ]
        }
      },
      "span": {
        "start": 41,
        "end": 50
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "A",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 61,
                "end": 62
              }
            },
            "attributes": [],
            "span": {
              "start": 57,
              "end": 62
            }
          }
        ]
      },
      "span": {
        "start": 51,
        "end": 62
      }
    },
    {
      "kind": {
        "Break": {
          "kind": "Error",
          "span": {
            "start": 69,
            "end": 74
          }
        }
      },
      "span": {
        "start": 63,
        "end": 68
      }
    },
    {
      "kind": {
        "Break": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 75,
            "end": 76
          }
        }
      },
      "span": {
        "start": 69,
        "end": 76
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": "Error",
          "span": {
            "start": 86,
            "end": 94
          }
        }
      },
      "span": {
        "start": 77,
        "end": 85
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 95,
            "end": 96
          }
        }
      },
      "span": {
        "start": 86,
        "end": 96
      }
    },
    {
      "kind": {
        "Return": {
          "kind": "Error",
          "span": {
            "start": 104,
            "end": 110
          }
        }
      },
      "span": {
        "start": 97,
        "end": 103
      }
    },
    {
      "kind": {
        "Return": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 111,
            "end": 112
          }
        }
      },
      "span": {
        "start": 104,
        "end": 112
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 118,
              "end": 120
            }
          }
        ]
      },
      "span": {
        "start": 113,
        "end": 120
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 127,
              "end": 129
            }
          }
        ]
      },
      "span": {
        "start": 121,
        "end": 130
      }
    },
    {
      "kind": {
        "Throw": {
          "kind": {
            "Variable": "x"
          },
          "span": {
            "start": 137,
            "end": 139
          }
        }
      },
      "span": {
        "start": 131,
        "end": 139
      }
    },
    {
      "kind": {
        "Goto": "label"
      },
      "span": {
        "start": 140,
        "end": 150
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "use", expecting "{" in Standard input code on line 3
