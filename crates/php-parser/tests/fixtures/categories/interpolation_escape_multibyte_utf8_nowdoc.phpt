===config===
min_php=7.4
===source===
<?php
// Nowdoc with multi-byte characters (no interpolation, like single-quoted strings)
$a = <<<'EOT'
test\è
EOT;

$b = <<<'EOT'
prefix {$x["key\è"]} suffix
EOT;

// Multiple escapes (literal, no processing)
$c = <<<'EOT'
\è\é\ù mixed
EOT;

// Escaped backslash before multi-byte
$d = <<<'EOT'
\\è escaped
EOT;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 90,
                  "end": 92
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "test\\è"
                  }
                },
                "span": {
                  "start": 95,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 115
          }
        }
      },
      "span": {
        "start": 90,
        "end": 116
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 118,
                  "end": 120
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "prefix {$x[\"key\\è\"]} suffix"
                  }
                },
                "span": {
                  "start": 123,
                  "end": 164
                }
              }
            }
          },
          "span": {
            "start": 118,
            "end": 164
          }
        }
      },
      "span": {
        "start": 118,
        "end": 165
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 212,
                  "end": 214
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "\\è\\é\\ù mixed"
                  }
                },
                "span": {
                  "start": 217,
                  "end": 245
                }
              }
            }
          },
          "span": {
            "start": 212,
            "end": 245
          }
        }
      },
      "span": {
        "start": 212,
        "end": 246
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 287,
                  "end": 289
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "\\\\è escaped"
                  }
                },
                "span": {
                  "start": 292,
                  "end": 317
                }
              }
            }
          },
          "span": {
            "start": 287,
            "end": 317
          }
        }
      },
      "span": {
        "start": 287,
        "end": 318
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 318
  }
}
