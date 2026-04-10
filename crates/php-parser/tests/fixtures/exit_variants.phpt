===source===
<?php exit; exit(); exit(0); die; die(); die('error');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 12,
            "end": 18
          }
        }
      },
      "span": {
        "start": 12,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "Int": 0
              },
              "span": {
                "start": 25,
                "end": 26
              }
            }
          },
          "span": {
            "start": 20,
            "end": 27
          }
        }
      },
      "span": {
        "start": 20,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 29,
            "end": 32
          }
        }
      },
      "span": {
        "start": 29,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 34,
            "end": 39
          }
        }
      },
      "span": {
        "start": 34,
        "end": 40
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "error"
              },
              "span": {
                "start": 45,
                "end": 52
              }
            }
          },
          "span": {
            "start": 41,
            "end": 53
          }
        }
      },
      "span": {
        "start": 41,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
