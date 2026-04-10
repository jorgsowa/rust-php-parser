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
            "end": 9
          }
        }
      },
      "span": {
        "start": 7,
        "end": 10
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
            "end": 13
          }
        }
      },
      "span": {
        "start": 11,
        "end": 14
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
            "end": 18
          }
        }
      },
      "span": {
        "start": 15,
        "end": 19
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
            "end": 23
          }
        }
      },
      "span": {
        "start": 20,
        "end": 24
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
            "end": 29
          }
        }
      },
      "span": {
        "start": 25,
        "end": 30
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
            "end": 36
          }
        }
      },
      "span": {
        "start": 31,
        "end": 37
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
            "end": 43
          }
        }
      },
      "span": {
        "start": 38,
        "end": 44
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
            "end": 49
          }
        }
      },
      "span": {
        "start": 45,
        "end": 50
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
            "end": 56
          }
        }
      },
      "span": {
        "start": 51,
        "end": 57
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
            "end": 63
          }
        }
      },
      "span": {
        "start": 58,
        "end": 64
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
            "end": 77
          }
        }
      },
      "span": {
        "start": 65,
        "end": 78
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
            "end": 111
          }
        }
      },
      "span": {
        "start": 79,
        "end": 112
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
            "end": 134
          }
        }
      },
      "span": {
        "start": 113,
        "end": 135
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 135
  }
}
