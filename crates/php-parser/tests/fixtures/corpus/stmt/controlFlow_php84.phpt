===config===
max_php=8.4
===source===
<?php

break;
break 2;

continue;
continue 2;

return;
return $a;

throw $e;

label:
goto label;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Break": null
      },
      "span": {
        "start": 7,
        "end": 13
      }
    },
    {
      "kind": {
        "Break": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 20,
            "end": 21
          }
        }
      },
      "span": {
        "start": 14,
        "end": 22
      }
    },
    {
      "kind": {
        "Continue": null
      },
      "span": {
        "start": 24,
        "end": 33
      }
    },
    {
      "kind": {
        "Continue": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 43,
            "end": 44
          }
        }
      },
      "span": {
        "start": 34,
        "end": 45
      }
    },
    {
      "kind": {
        "Return": null
      },
      "span": {
        "start": 47,
        "end": 54
      }
    },
    {
      "kind": {
        "Return": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 62,
            "end": 64
          }
        }
      },
      "span": {
        "start": 55,
        "end": 65
      }
    },
    {
      "kind": {
        "Throw": {
          "kind": {
            "Variable": "e"
          },
          "span": {
            "start": 73,
            "end": 75
          }
        }
      },
      "span": {
        "start": 67,
        "end": 76
      }
    },
    {
      "kind": {
        "Label": "label"
      },
      "span": {
        "start": 78,
        "end": 84
      }
    },
    {
      "kind": {
        "Goto": "label"
      },
      "span": {
        "start": 85,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
===php_error===
PHP Fatal error:  'break' not in the 'loop' or 'switch' context in Standard input code on line 3
