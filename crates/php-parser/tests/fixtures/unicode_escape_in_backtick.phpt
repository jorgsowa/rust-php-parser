===source===
<?php
`echo \u{1F600}`;
`\u{65}`;
`prefix\u{263A}suffix`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "echo 😀"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "e"
              }
            ]
          },
          "span": {
            "start": 24,
            "end": 32
          }
        }
      },
      "span": {
        "start": 24,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "prefix☺suffix"
              }
            ]
          },
          "span": {
            "start": 34,
            "end": 56
          }
        }
      },
      "span": {
        "start": 34,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
