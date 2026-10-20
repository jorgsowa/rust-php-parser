===source===
<?php
`echo \\test`;
`echo \\`;
`\\\\`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "echo \\test"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "echo \\"
              }
            ]
          },
          "span": {
            "start": 21,
            "end": 30
          }
        }
      },
      "span": {
        "start": 21,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "\\\\"
              }
            ]
          },
          "span": {
            "start": 32,
            "end": 38
          }
        }
      },
      "span": {
        "start": 32,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
