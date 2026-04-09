===source===
<?php

'';
"";
b'';
b"";
'Hi';
b'Hi';
B'Hi';
"Hi";
b"Hi";
B"Hi";
'!\'!\\!\a!';
"!\"!\\!\$!\n!\r!\t!\f!\v!\e!\a";
"!\xFF!\377!\400!\0!";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ""
          },
          "span": {
            "start": 7,
            "end": 9,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 11,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ""
          },
          "span": {
            "start": 11,
            "end": 13,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 11,
        "end": 15,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ""
          },
          "span": {
            "start": 15,
            "end": 18,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": ""
          },
          "span": {
            "start": 20,
            "end": 23,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 25,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 25,
            "end": 29,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 31,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 31,
            "end": 36,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 38,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 38,
            "end": 43,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 38,
        "end": 45,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 45,
            "end": 49,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 45,
        "end": 51,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 51,
            "end": 56,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 58,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "Hi"
          },
          "span": {
            "start": 58,
            "end": 63,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 65,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "!'!\\!\\a!"
          },
          "span": {
            "start": 65,
            "end": 77,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 65,
        "end": 79,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "!\"!\\!$!\n!\r!\t!\f!\u000b!\u001b!\\a"
          },
          "span": {
            "start": 79,
            "end": 111,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 79,
        "end": 113,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "!ÿ!ÿ!!\u0000!"
          },
          "span": {
            "start": 113,
            "end": 134,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 113,
        "end": 135,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 135,
    "start_line": 1,
    "start_col": 0
  }
}
